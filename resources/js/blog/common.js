export default {
	data(){
		return {

		}
	},
	methods:{
		async callApi(method,url,dataObj){
			try{
				return await axios({
				  method: method,
				  url: url,
				  data: dataObj
				});
			}catch(e){
				return e.response;	
				  // return res.status(500).send(e);		
			}
		},
		 info (title="Hey.",desc) {
                this.$Notice.info({
                    title: title,
                    desc: desc
                });
            },
            success (title="Success.",desc) {
                this.$Notice.success({
                    title: title,
                    desc: desc
                });
            },
            warning (title="Warning.",desc) {
                this.$Notice.warning({
                   title: title,
                    desc: desc
                });
            },
            error (title="OOPS.",desc) {
                this.$Notice.error({
                    title: title,
                    desc: desc
                });
            },
            errorDefault (title="OOPS.",desc ="Something Went Wrong. Try Again.") {
                this.$Notice.error({
                    title: title,
                    desc: desc
                });
            },

	},
}