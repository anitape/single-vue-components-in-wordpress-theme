(function() {

        const MFilter = {
            data() {
                return {
                    activeFilter: '',
                }
            },
            methods: {
                setFilter(filter) {
                    this.activeFilter = filter;
                }
            },
            render(h) {
                return this.$scopedSlots.default({
                    activeFilter: this.activeFilter,
                    setFilter: this.setFilter,
                });
            },
        };

        const app = Vue.createApp(MFilter);
        app.mount('#filter-component');
   //});
})();