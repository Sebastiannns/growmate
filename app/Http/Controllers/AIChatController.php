<?php

namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'asc')
            ->get();

        return view('ai-chat.index', compact('messages'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => ['required', 'string', 'max:1000'],
        ]);

        $userMessage = $request->message;

        ChatMessage::create([
            'user_id' => auth()->id(),
            'message' => $userMessage,
            'sender' => 'user',
        ]);

        $response = $this->generateWithGemini($userMessage);

        ChatMessage::create([
            'user_id' => auth()->id(),
            'message' => $response,
            'sender' => 'ai',
        ]);

        return redirect()->route('ai-chat.index');
    }

    protected function generateWithGemini(string $message): string
    {
        $apiKey = config('services.gemini.api_key');

        if (!$apiKey) {
            return 'Maaf, AI sedang tidak tersedia. Coba lagi nanti ya! 😊';
        }

        $history = ChatMessage::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get()
            ->reverse()
            ->values();

        $contents = [];
        foreach ($history as $msg) {
            $role = $msg->sender === 'user' ? 'user' : 'model';
            $contents[] = [
                'role' => $role,
                'parts' => [['text' => $msg->message]],
            ];
        }

        try {
            $response = Http::timeout(30)->post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite:generateContent?key=' . $apiKey,
                [
                    'systemInstruction' => [
                        'parts' => [
                            [
                                'text' => 'Kamu adalah GrowMate AI, asisten pribadi yang ramah dan peduli untuk mahasiswa Indonesia. Tugasmu adalah memberikan dukungan kesehatan mental, motivasi belajar, saran akademik, dan teman ngobrol yang hangat. Gunakan bahasa Indonesia yang natural, hangat, dan bersahabat. Sesekali kamu boleh menggunakan emoji. Jangan terlihat seperti robot — jadilah seperti teman yang peduli. Jika mahasiswa bercerita tentang masalah, berikan empati terlebih dahulu baru saran. Jawab dengan singkat dan padat, maksimal 3-4 kalimat.',
                            ],
                        ],
                    ],
                    'contents' => $contents,
                    'generationConfig' => [
                        'maxOutputTokens' => 300,
                        'temperature' => 0.7,
                    ],
                ]
            );

            if ($response->successful()) {
                $data = $response->json();
                $candidate = $data['candidates'][0] ?? null;

                if (!$candidate) {
                    logger('Gemini: no candidates', ['body' => $response->body()]);
                    return 'Hmm, aku belum bisa merespons itu. Coba tanya yang lain ya! 🤗';
                }

                $finishReason = $candidate['finishReason'] ?? 'UNKNOWN';
                if (in_array($finishReason, ['SAFETY', 'BLOCKED', 'RECITATION'])) {
                    logger("Gemini: blocked ($finishReason)", ['message' => $message]);
                    return 'Maaf, aku tidak bisa menjawab itu. Yuk diskusi hal lain! 😊';
                }

                $text = $candidate['content']['parts'][0]['text'] ?? null;
                if ($text !== null) {
                    return trim($text);
                }

                logger('Gemini: empty text', ['finishReason' => $finishReason, 'body' => $response->body()]);
                return 'Maaf, aku belum bisa menjawab itu. Coba tanya yang lain ya! 😊';
            }

            logger('Gemini API error:', ['status' => $response->status(), 'body' => $response->body()]);
            return 'Maaf, aku lagi sibuk nih. Coba tanya lagi nanti ya! 😅';
        } catch (\Exception $e) {
            logger('Gemini API exception:', ['message' => $e->getMessage()]);
            return 'Wah, koneksinya bermasalah. Coba ulangi ya! 🙏';
        }
    }
}
