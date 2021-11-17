export default {
    install: (app, options) => {
        app.config.globalProperties.$indexApi = async function (
            rota,
            perPage,
            data,
            search,
            paginate,
            ordenaKey,
            ordenaVal) {
            let url = paginate !== true ? rota + "?" : rota + '&';

            if (search && search !== "") {
                url += "search=" + search + "&";
            }

            if (perPage && perPage !== "") {
                url += "per_page=" + perPage + "&";
            }

            if (ordenaKey && ordenaKey !== "") {
                url += "orderByKey=" + ordenaKey + "&";
            }

            if (ordenaVal && ordenaVal !== "") {
                url += "orderByVal=" + ordenaVal + "&";
            }

            this.$store.state.loading = true;
            let axiosResponse = await axios
                .get(url, data)
                .then((response) => {
                    this.$store.state.loadingTable = true;
                    return response.data
                })
                .catch((error) => {
                    if (error.response.data.errors) {
                        let msgError = "<ul style='margin:0'>";
                        for (let [key, value] of Object.entries(
                            error.response.data.errors
                        )) {
                            console.log(key, value);
                            msgError += "<li>" + value + "</li>";
                        }
                        msgError += "</ul>";
                        console.log(msgError);
                        this.$store.state.showAlert = true;
                        this.$store.state.typeAlert = "warning";
                        this.$store.state.msgAlert = msgError;
                    } else {
                        this.$store.state.showAlert = true;
                        this.$store.state.typeAlert = "danger";
                        this.$store.state.msgAlert = "Ops! Algo deu errado.";
                    }
                })
                .finally(() => {
                    this.$store.state.loading = false;
                });
            return axiosResponse
        }
    }
}