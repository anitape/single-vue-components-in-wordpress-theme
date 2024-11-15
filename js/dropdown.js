(function () {

        const { createApp } = Vue

        createApp({
            data() {
                return {
                    isVisible: 'hidden',
                }
            },
            methods: {
                makeVisible() {
                    if (this.isVisible === 'hidden') {
                        this.isVisible = 'visible'
                    } else { this.isVisible = 'hidden' }
                }
            }
        }).mount('#my-first-dropdown')
})();