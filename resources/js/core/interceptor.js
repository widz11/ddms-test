window.axios.interceptors.response.use((response) => {
    return response;
}, (error) => {

    if (error.response.status >= 500) {
        swal.fire('Internal Server Error', 'Please contact system administrator', 'error');
    } else if (error.response.status == 403) {
        swal.fire('Forbidden', 'You don\'t have permission to perform this action', 'error');
    }

    return Promise.reject(error);
});