$(function () {
    $('#dataTable').DataTable({
        "oLanguage": {
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "Nenhum registro encontrado",
            "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
            "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros)",
            "sSearch": "Pesquisar: ",
            "oPaginate": {
                "sFirst": "Início",
                "sPrevious": "Anterior",
                "sNext": "Próximo",
                "sLast": "Último"
            }
        },
        "order": [[0, "asc"]]
    });
});

$(document).ready(function () {
    $('#summernote').summernote({
        minHeight: 300,
        lang: 'pt-BR',
    });
});

$(function () {
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