<template>

</template>

<script>

    export default {
        props: [
            'business_slug'
        ],
        data() {
            return {
                baseUrl: location.protocol + '//' + location.host,
                status: 'loading',
                slug: this.business_slug
            }
        },

        methods: {
            /**
             * Get Business Info
             */
            getBusiness(slug) {
                this.status = 'loading';

                var url = this.baseUrl + "/api/business/" + slug;
                axios.get(url)
	                .then(response => {
                        this.status         = 'done';
                        this.notifications  = response.data.data;
                        this.total          = response.data.total;
	                })
	                .catch(error => {
				        this.status = 'error';
				        new Noty({
	                      	title: 'Error',
	                      	text: 'Error, Something Went Wrong, Please Try To Reload The Page.',
	                      	type: "error"
	                  	}).show();
				    });
            }

        },

        created() {
            // console.log("Reading");
        },

        mounted() {
            console.log("Component Mounted");
            this.getBusiness(this.slug);
        }
    };
</script>