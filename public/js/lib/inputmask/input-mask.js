$(function () {

    Inputmask.extendAliases
        ({
            'mask-cpf':
            {
                'mask': '999.999.999-99',
                'allowMinus': false,
                'greedy': false,
                'placeholder': '_',
                'clearMaskOnLostFocus': true
            }
        });

    Inputmask.extendAliases
        ({
            'mask-zipcode':
            {
                'mask': '99999-999',
                'allowMinus': false,
                'greedy': false,
                'placeholder': '_',
                'clearMaskOnLostFocus': true
            }
        });

    Inputmask.extendAliases
        ({
            'mask-telephone':
            {
                'mask': '(99) 9999-9999',
                'allowMinus': false,
                'greedy': false,
                'placeholder': '_',
                'clearMaskOnLostFocus': true
            }
        });

    Inputmask.extendAliases
        ({
            'mask-cellphone':
            {
                'mask': '(99) 99999-9999',
                'allowMinus': false,
                'greedy': false,
                'placeholder': '_',
                'clearMaskOnLostFocus': true
            }
        });

    $('.mask-cpf').inputmask({ 'alias': 'mask-cpf' });
    $('.mask-zipcode').inputmask({ 'alias': 'mask-zipcode' });
    $('.mask-telephone').inputmask({ 'alias': 'mask-telephone' });
    $('.mask-cellphone').inputmask({ 'alias': 'mask-cellphone' });

    $("#cpf").inputmask({removeMaskOnSubmit: true});
    $("#zipcode").inputmask({removeMaskOnSubmit: true});
    $("#telephone").inputmask({removeMaskOnSubmit: true});
    $("#cellphone").inputmask({removeMaskOnSubmit: true});
    $("#whatsapp").inputmask({removeMaskOnSubmit: true});
});