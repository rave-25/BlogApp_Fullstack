import axios from 'axios';

export default {
    data() {
        return {};
    },
    methods: {
        async callApi(method, url, reqdata = {}) {
            console.log("Calling API with method:", method, "URL:", url, "Data:", reqdata); 
            try {
                const response = await axios({
                    method,
                    url,
                    data: reqdata,
                });
                return response;
            } catch (e) {
                console.error("API call error:", e);  // Log error for debugging
                return e.response;
            }
        },
        i(desc, title = "Hey") {
            this.$Notice.info({
                title: title,
                desc: desc
            });
        },
        s(desc, title = "Great!") {
            this.$Notice.success({
                title: title,
                desc: desc
            });
        },
        w(desc, title = "Oops!") {
            this.$Notice.warning({
                title: title,
                desc: desc
            });
        },
        e(desc, title = "Oops!") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        }, 
        swr(desc = 'Something went wrong! Please try again.', title = "Oops") {
            this.$Notice.error({
                title: title,
                desc: desc
            });
        }
    }
};
