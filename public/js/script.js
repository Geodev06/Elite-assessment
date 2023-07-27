
function makeRequest(url, method, data, before, success, error) {
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: 'json',
        beforeSend: function () {
            if (typeof success === 'function') {
                before();
            }
        },
        success: function (response) {
            if (typeof success === 'function') {
                success(response);
            }
        },
        error: function (xhr, status, err) {
            if (typeof error === 'function') {
                error(xhr, status, err);
            } else {
                console.error('AJAX Error:', xhr.responseText);
            }
        }
    });
}
