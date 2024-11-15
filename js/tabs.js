(function() {

    //document.querySelectorAll('.tab-component')
    //.forEach((el) => {
        //const { createApp } = Vue

        const MTabs = {
            data() {
                return {
                    tabIndex: 1,
                }
            },
        };

        const app = Vue.createApp(MTabs);
        app.mount('#tab-component');
   //});
})();