
$('#submit-form-button').on('click', sendForm);


function sendForm() {

    let data = $("#form-filter").serialize();
    console.log(data);
    $.ajax({
        type: 'POST',
        url: '../app/CurlRequestController.php',
        data: data,
        dataType: 'JSON',
        encode: true,
        success: function (response, textStatus, xhr) {
            response;
            console.log(response);
            $("#declaration-list tbody").html('Ожидание данных');
            if (!response.code) {
                var tbody = '';
                $.each(response, function (index, value) {
                    // alert( index + ": " + value );
                    tbody += '<tr>' +
                        '<td>' + value.id + '</td>' +
                        '<td>' + value.idStatus + '</td>' +
                        '<td>' + value.number + '</td>' +
                        '<td>' + value.declDate + '</td>' +
                        '<td>' + value.declEndDate + '</td>' +
                        '<td>' + value.productFullName + '</td>' +
                        '<td>' + value.applicantName + '</td>' +
                        '<td>' + value.manufacterName + '</td>' +
                        '<td>' + value.productOrig + '</td>' +
                        '<td>' + value.declObjectType + '</td>' +
                        '</tr>';

                });
                $("#declaration-list tbody").html(tbody);
            }else{
                alert(JSON.stringify(response));
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
        }
    })
}