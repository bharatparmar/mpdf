$(document).ready(function () {
    $(function () {
        createCookie = function (name, value, days) {
            var expires;
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toGMTString();
            } else {
                expires = "";
            }
            document.cookie = name + "=" + value + expires + "; path=/";
        }



        readCookie = function (name) {
            var nameEQ = encodeURIComponent(name) + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) === ' ')
                    c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) === 0)
                    return decodeURIComponent(c.substring(nameEQ.length, c.length));
            }
            return null;
        }

        eraseCookie = function (name) {
            createCookie(name, "", -1);
        }

        in_array = function (needle, haystack){
            var found = 0;
            for (var i=0, len=haystack.length;i<len;i++) {
                if (haystack[i] == needle) return i;
                found++;
            }
            return -1;
        }

        noData = function() {
            alert($('#no-data').val());
        }

        if (!readCookie('savedArticle')) {
            $('#savedItemOpener').hide();
        }

        $('.saveArticle').each(function(){
            uid = $(this).attr('id');
            if (readCookie('savedArticle')) {
                savedArray = readCookie('savedArticle').split(',');
                if (in_array(uid, savedArray) != -1) {
                    $(this).parent().append('<a href="javascript:;" class="discardArticle" data-id="'+uid+'"><i class="ion-heart"></i></a>');
                    $(this).parent().find('#'+uid).remove()
                }
            }
        })

        $(document).on('click', '.saveArticle', function(){
            uid = $(this).attr('id');
            if (readCookie('savedArticle')) {
                savedArray = readCookie('savedArticle').split(',');
                if (in_array(uid, savedArray) == -1) {
                    savedArticle = readCookie('savedArticle') + ',' + uid;
                }
            } else {
                savedArticle = uid;
            }
            createCookie('savedArticle', savedArticle, 0);
            $(this).parent().append('<a href="javascript:;" class="discardArticle" data-id="'+uid+'"><i class="ion-heart"></i></a>');
            $(this).parent().find('#'+uid).remove();
            if (readCookie('savedArticle')) {
                $('#savedItemOpener').show();
            }
        })

        $(document).on('click', '.discardArticle', function(){
            uid = $(this).attr('data-id');
            wishHtml = '<a id="'+uid+'" class="btn btn-default btn-appear saveArticle" href="javascript:;">'
            wishHtml += '<span>'+$('#merken').val()+'<i class="ion-heart"></i></span></a>';

            if (readCookie('savedArticle')) {
                savedArray = readCookie('savedArticle').split(',');
                resetArray = new Array()
                for (i = 0;i < savedArray.length; i++) {
                    if (uid != savedArray[i]) {
                        resetArray.push(savedArray[i])
                    }
                }
                savedArticle = resetArray.join(',');
                createCookie('savedArticle', savedArticle, 0);
                $(this).parent().append(wishHtml);
                $(this).parent().find('.discardArticle').remove();
            }

            if (!readCookie('savedArticle')) {
                $('#savedItemOpener').hide();
            }
        });


        $(document).on('click', '.removeWish', function(){
            uid = $(this).attr('data-id');
            wishHtml = '<a id="'+uid+'" class="btn btn-default btn-appear saveArticle" href="javascript:;">'
            wishHtml += '<span>'+$('#merken').val()+'<i class="ion-heart"></i></span></a>';

            if (readCookie('savedArticle')) {
                savedArray = readCookie('savedArticle').split(',');
                resetArray = new Array()
                for (i = 0;i < savedArray.length; i++) {
                    if (uid != savedArray[i]) {
                        resetArray.push(savedArray[i])
                    }
                }
                savedArticle = resetArray.join(',');
                createCookie('savedArticle', savedArticle, 0);
                $('#remove-'+uid).remove();
                if ($('.discardArticle[data-id="'+uid+'"]').length) {
                    $('.discardArticle[data-id="'+uid+'"]').parent().append(wishHtml);
                    $('.discardArticle[data-id="'+uid+'"]').parent().find('.discardArticle').remove();
                }
            }
        });

        $(document).on('click', '#savedItemOpener', function(){
            savedArticle = readCookie('savedArticle');
            url = $(this).attr('data-url');

            $.ajax({
                url:url,
                data:{
                    type: 666,
                    savedArticle: savedArticle
                },
                success: function(data) {
                    $('#savedHidden').val(savedArticle);
                    $('#displaySavedItems').html(data)
                    $('#savedItemModal').modal('show');
                }
            })
        });

        $(document).on('click', '#sendWishPdf', function(){
            $('#displaySavedItems').hide();
            $('.modal-footer').hide();
            $('#contactForm').show();
            /*if (readCookie('savedArticle')){
                $(this).html('<i class="fal fa-sync fa-spin"></i> '+$('#load-saving').val()+'...');
                $(this).prop('disabled', true);
                $('#savedHidden').val(readCookie('savedArticle'));
                $('#SavedItemFrm').submit();


                setTimeout(function () {
                    $('#sendWishPdf').html($('#pdf-saved').val() + ' <i class="fal fa-check-circle"></i>');
                    $('#sendWishPdf').prop('disabled', false);
                }, 6000);
            } else {
                noData();
            } */
        });
        if ($('#contactform').length > 0) {
            $('#contactform').validate({rules: {
                    "tx_kastenhubertheme_page[email]": {
                        required: true,
                        email: true,
                    },
                    "tx_kastenhubertheme_page[terms]": {
                        required: true,
                    }
                },
                messages: {
                    "tx_kastenhubertheme_page[email]": "Bitte geben Sie eine gültige EMail-Adresse an.",
                    "tx_kastenhubertheme_page[terms]": "Bitte bestätigen Sie unsere Datanschutzerklärung.",
                },
                submitHandler: function(form) {
                    $('#submit-contactform').html('<i class="fal fa-sync fa-spin"></i> '+$('#load-saving').val()+'...');
                    $('#submit-contactform').prop('disabled', true);
                    url = '/';
                    var formArray = [];
                    $('.form-control').each(function() {
                        formArray.push($(this).val());
                    });
                    formArray.push(readCookie('savedArticle'));
                    $.ajax({
                        url:url,
                        data:{
                            type: 667,
                            form:formArray,
                        },
                        success: function(data) {
                            if(data == '1') {
                                if (readCookie('savedArticle')){
                                    //$('#submit-contactform').html('<i class="fal fa-sync fa-spin"></i> '+$('#load-saving').val()+'...');
                                    $('#submit-contactform').html($('#pdf-saved').val() + ' <i class="fal fa-check-circle"></i>');
                                    $('#submit-contactform').prop('disabled', false);
                                    $('#savedHidden').val(readCookie('savedArticle'));
                                    $('#SavedItemFrm').submit();

                                    setTimeout(function () {

                                        $('#savedItemModal').find('input:text').val('');
                                        $('input:checkbox').removeAttr('checked');
                                        $('#savedItemModal').modal('toggle');
                                        eraseCookie('savedArticle');
                                        $('#contactForm').hide();
                                        $('#displaySavedItems').show();
                                        $('.modal-footer').show();
                                        window.location.reload();
                                    }, 6000);
                                } else {
                                    noData();
                                }
                            }
                        }
                    });
                }
            });
        }

        validateEmail = function (email) {
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        $(document).on('click', '#sendEmailPdf', function(){
            btnVal = $(this).html();
            if (readCookie('savedArticle')) {
                savedArticle = readCookie('savedArticle');
                emailVal = $('#pdf-email').val();
                gdpr = $('#gdpr').prop('checked');
                if (gdpr) {
                    if (validateEmail(emailVal)) {
                        $(this).html('<i class="fal fa-sync fa-spin"></i> '+$('#load-sending').val()+'...');
                        $(this).prop('disabled', true);
                        url = $('#SavedItemFrm').attr('action');
                        savedHidden = $('#savedHidden').val();

                        $.ajax({
                            url:url,
                            type: 'POST',
                            data:{
                                savedHidden : savedHidden,
                                email:1,
                                emailVal:emailVal
                            },
                            success: function(data) {
                                $('#sendEmailPdf').prop('disabled', false);
                                $('#sendEmailPdf').html($('#email-sent').val() + ' <i class="fal fa-check-circle"></i>');
                            }
                        })
                    } else {
                        alert($('#invalid-email').val());
                        $('#pdf-email').focus();
                    }
                } else {
                    alert($('#invalid-gdpr').val());
                    $('#gdpr').focus();
                }
            } else {
                noData();
            }
        });

        if (getCookie('cartArticle')) {
            savedArray = JSON.parse(getCookie('cartArticle'));
            if(savedArray.length){
                $('.cart').show();
            }
            else{
                $('.cart').hide();
                createCookie('cartArticle', "", -1);
            }
        }

        $(document).on('click', '.addToCart', function(){
            uid = $(this).attr('id');
            var closest =  $(this).closest('.webshop-container');
            if (getCookie('cartArticle')) {
                savedArray = JSON.parse(getCookie('cartArticle'));
                var cartItems = new Array();
                var exist = 0;
                for(i=0;i<savedArray.length;i++){
                    var inner = Object.keys(savedArray[i]).map(function(key) {
                      return [key, savedArray[i][key]];
                    });
                    var newArray = new Array();
                    for(j=0;j<inner.length;j++){
                        newArray[inner[j][0]]=inner[j][1];
                    }

                    if (uid == newArray['uid']) {
                        exist = 1;
                        newArray['items'] = parseInt(newArray['items'])+ parseInt(closest.find('.item-count').val());
                    }
                    if(parseInt(newArray['items']) > 0){
                        cartItems.push(Object.assign({}, newArray));
                        console.log('show');
                        $('.cart').show();
                    }

                }
                if(exist ==0)
                {
                    var newItem = new Array();
                    newItem['uid'] = uid;
                    newItem['img'] = closest.find('.lightbox img').attr('src');
                    newItem['title'] = closest.find('.title').html();
                    newItem['description'] = closest.find('.text p').html();
                    newItem['price'] = closest.find('.price').html();
                    newItem['items'] = parseInt(closest.find('.item-count').val());
                    if(parseInt(newItem['items']) > 0){
                        cartItems.push(Object.assign({}, newItem));

                    }

                }
                cartArticle = JSON.stringify(cartItems);


            } else {
                var cartItems = new Array();
                var newItem = new Array();

                newItem['uid'] = uid;
                newItem['img'] = closest.find('.lightbox img').attr('src');
                newItem['title'] = closest.find('.title').html();
                newItem['description'] = closest.find('.text p').html();
                newItem['price'] = closest.find('.price').html();
                newItem['items'] = parseInt(closest.find('.item-count').val());

                cartItems.push(Object.assign({}, newItem));
                $('.cart').show();
                cartArticle = JSON.stringify(cartItems);

            }
            createCookie('cartArticle', cartArticle, 0);

        });

        $(document).on('click', '.cart', function(){
            $('.modal-body').html('<div class="loader-container"><div class="loader"></div></div>');
            if (getCookie('cartArticle')) {
                savedArray = JSON.parse(getCookie('cartArticle'));
                var html = '';
                for(i=0;i< savedArray.length;i++){
                   // console.log(Object.keys(savedArray[i]).map(i => savedArray[i]));
                    var inner = Object.keys(savedArray[i]).map(function(key) {
                      return [key, savedArray[i][key]];
                    });
                    var newArray = new Array();
                    for(j=0;j<inner.length;j++){
                        newArray[inner[j][0]]=inner[j][1];
                    }

                    $.ajax({
                        url:'/',
                        data:{
                            type: 885
                        },
                        contentType: "text/html;charset=utf-8",
                        success: function(data) {
                            if(data) {
                                $('.modal-content').html(data);

                            }
                        }
                    });


                }


            }

        });
        $(document).on('click', '.removeFromCart', function(){
            uid = $(this).attr('id');
            var closest =  $(this).closest('tr');
            if (getCookie('cartArticle')) {
                savedArray = JSON.parse(getCookie('cartArticle'));
                var cartItems = new Array();
                var exist = 0;
                for(i=0;i<savedArray.length;i++){
                    var inner = Object.keys(savedArray[i]).map(function(key) {
                      return [key, savedArray[i][key]];
                    });
                    var newArray = new Array();
                    for(j=0;j<inner.length;j++){
                        newArray[inner[j][0]]=inner[j][1];
                    }

                    if (uid == newArray['uid']) {
                        exist = 1;
                        newArray['items'] = 0;
                        /*if(parseInt(newArray['items']) >= parseInt(closest.find('.item-count').val())){
                            newArray['items'] = parseInt(newArray['items']) - parseInt(closest.find('.item-count').val());
                        }
                        else{
                            alert('removed quantity is greater then added');
                            return false;
                        }*/
                    }

                    if(parseInt(newArray['items'])==0){
                       $(this).closest('tr').remove();
                    }
                    if(parseInt(newArray['items']) > 0){
                        cartItems.push(Object.assign({}, newArray));
                    }
                }

                cartArticle = JSON.stringify(cartItems);
                createCookie('cartArticle', cartArticle, 0);
                 $('.modal-body').html('<div class="loader-container"><div class="loader"></div></div>');
                $.ajax({
                    url:'/',
                    data:{
                        type: 885
                    },
                    contentType: "text/html;charset=utf-8",
                    success: function(data) {
                        if(data) {
                            $('.modal-content').html(data);

                        }
                    }
                });


            }

        });
        $(document).on('change', '.item-count', function(){
            uid = ($(this).attr('id')).replace("item-", "");;
            var closest =  $(this).closest('tr');
            if (getCookie('cartArticle')) {
                savedArray = JSON.parse(getCookie('cartArticle'));
                var cartItems = new Array();
                var exist = 0;
                for(i=0;i<savedArray.length;i++){
                    var inner = Object.keys(savedArray[i]).map(function(key) {
                      return [key, savedArray[i][key]];
                    });
                    var newArray = new Array();
                    for(j=0;j<inner.length;j++){
                        newArray[inner[j][0]]=inner[j][1];
                    }

                    if (uid == newArray['uid']) {
                        exist = 1;
                        newArray['items'] = parseInt(closest.find('.item-count').val());
                       /* if(parseInt(newArray['items']) >= parseInt(closest.find('.item-count').val())){
                            newArray['items'] = parseInt(newArray['items']) - parseInt(closest.find('.item-count').val());
                        }
                        else{
                            alert('removed quantity is greater then added');
                            return false;
                        }*/
                    }

                    if(parseInt(newArray['items'])==0){
                       $(this).closest('tr').remove();
                    }
                    if(parseInt(newArray['items']) > 0){
                        cartItems.push(Object.assign({}, newArray));
                    }
                }

                cartArticle = JSON.stringify(cartItems);
                createCookie('cartArticle', cartArticle, 0);
                 $('.modal-body').html('<div class="loader-container"><div class="loader"></div></div>');
                $.ajax({
                    url:'/',
                    data:{
                        type: 885
                    },
                    contentType: "text/html;charset=utf-8",
                    success: function(data) {
                        if(data) {
                            $('.modal-content').html(data);

                        }
                    }
                });


            }

        });
        $(document).on('click', '.showForm', function(){
             $('.modal-body').html('<div class="loader-container"><div class="loader"></div></div>');
            $.ajax({
                url:'/',
                data:{
                    type: 886
                },
                contentType: "text/html;charset=utf-8",
                success: function(data) {
                    if(data) {
                        $('.modal-content').html(data);
                    }
                }
            });
        });

        $(document).on('submit', '#sendQuote', function(event){

            event.preventDefault();
             $('.form-control').each(function() {

                if($(this).attr('required')){
                    if($(this).val()=='')
                    {
                        $(this).addClass('error');

                    }
                    else{

                        $(this).removeClass('error');
                    }
                }

                if($('#gdpr:checked').length)
                {
                    $('#gdpr').removeClass('error');
                }else{
                    $('#gdpr').addClass('error');
                }

                var input=$("input[name='email']");
                var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                var is_email=re.test(input.val());
                if(is_email){ input.removeClass('error');}
                else{input.addClass('error');}


            });
             if($('#sendQuote').find('.error').length){

                return false;
             }
            $('.modal-body').html('<div class="loader-container"><div class="loader"></div></div>');
            url = '/';
            $.ajax({
                url:url,
                async: false,
                data:{
                    type: 884,
                    params:$(this).serializeArray()
                },
                contentType: "text/html;charset=utf-8",
                success: function(data) {
                    if(data == '1') {

                        $.ajax({
                            url:url,
                            async: false,
                            data:{
                                type: 887
                            },
                            success: function(data) {
                                if(data) {

                                    $('.modal-content').html(data);

                                    createCookie('cartArticle', "", -1);

                                }
                            }
                        });


                    }
                }
            });
        });
        $(document).on('click', '.closeAndReload', function(){
            window.location.reload();
        });

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = document.cookie;

            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
            }
            return "";
        }
    })

});
