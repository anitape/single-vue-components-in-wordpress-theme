(function () {
    const { createApp } = Vue

    const MSlider = {
        data() {
            return {
                activeImage: 0,
                totalImages: 0,
            }
        },
        methods: {
            setTotalImages(images) {
                this.totalImages = images;
            },
            nextSlide() { 
                if (this.activeImage >= this.totalImages - 1) 
                    { this.activeImage = 0; return; 

                    } 
                    this.activeImage++;
            },
            prevSlide() { 
                if (this.activeImage == 0) 
                    { this.activeImage = this.totalImages - 1; 
                        return; 
                    } 
                this.activeImage--; 
            }, 
            setActiveImage(number) { 
                this.activeImage = number; 
            }
        },
        mounted() {
            setInterval(() => {
                if (this.activeImage >= this.totalImages - 1) {
                    this.activeImage = 0;
                    return;
                }
                this.activeImage++;
            }, 5000);
        },

    }

    createApp(MSlider).mount('#slider')
})();