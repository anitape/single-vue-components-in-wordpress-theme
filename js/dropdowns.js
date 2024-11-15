(function () {

    document.querySelectorAll('.menu-dropdown').forEach((element) => {
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
        }).mount(element)
    })
})();