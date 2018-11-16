$(function () {

    $('#state_id').change(function () {

        var id = $('#state_id').val();
        var url = window.location.href;
        var input = $('#city_id');

        if (id > 0) {
            $.ajax({
                url: url + '/estado/cidades/' + id,
                dataType: 'json',
                success: function (data) {

                    $('#city_id').prop('disabled', false);
                    input.html('');
                    $(input).append('<option value="">Selecione uma cidade</option>');

                    $.each(data, function (i, val) {
                        $(input).append('<option value="' + val.id + '">' + val.name + '</option>');
                    });

                }
            });
        } else {
            $('#city_id').prop('disabled', true);
            input.html('');
            $(input).append('<option value=""></option>');
        }

    });

    $('.delete-confirm').on('click', function () {
        var url = $(this).val();
        swal({
            title: "Você tem certeza que deseja apagar este registro?",
            text: "Após ser apagado o registro não poderá ser recuperado",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sim, apagar",
            cancelButtonText: "Não, cancelar",
            closeOnConfirm: false,
            closeOnCancel: false
        },
            function (isConfirm) {
                if (isConfirm) {
                    swal({
                        title: "Apagado",
                        text: "O registro foi apagado com sucesso",
                        type: "success"
                    },
                        function (isConfirm) {
                            window.location = url;
                        });
                }
                else {
                    swal("Cancelado", "O registro não foi apagado", "error");
                }
            });
    });

});