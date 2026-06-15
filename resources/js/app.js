// GrowMate — Alpine.js app initialization
import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.store('app', {
        activeTab: 'home',
        setActiveTab(tab) {
            this.activeTab = tab;
        },
    });

    Alpine.data('growmateApp', () => ({
        init() {
            const path = window.location.pathname;
            if (path.includes('/mood')) this.$store.app.setActiveTab('mood');
            else if (path.includes('/community')) this.$store.app.setActiveTab('community');
            else if (path.includes('/consultation')) this.$store.app.setActiveTab('consultation');
            else if (path.includes('/profile')) this.$store.app.setActiveTab('profile');
            else if (path.includes('/tasks')) this.$store.app.setActiveTab('task');
            else if (path.includes('/timer')) this.$store.app.setActiveTab('timer');
            else if (path.includes('/materials')) this.$store.app.setActiveTab('material');
            else if (path.includes('/ai-chat')) this.$store.app.setActiveTab('ai-chat');
            else if (path.includes('/notifications')) this.$store.app.setActiveTab('notifications');
            else if (path.includes('/analytics')) this.$store.app.setActiveTab('analytics');
            else if (path.includes('/counselor/schedule')) this.$store.app.setActiveTab('schedule');
            else if (path.includes('/counselor/articles')) this.$store.app.setActiveTab('articles');
            else if (path.includes('/admin/users')) this.$store.app.setActiveTab('users');
            else if (path.includes('/admin/materials')) this.$store.app.setActiveTab('materials');
            else if (path.includes('/admin')) this.$store.app.setActiveTab('home');
            else if (path.includes('/counselor')) this.$store.app.setActiveTab('home');
            else this.$store.app.setActiveTab('home');
        },
    }));
});

Alpine.start();
