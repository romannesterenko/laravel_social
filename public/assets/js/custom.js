$(function (){
    displayCheckTab()
    $(window).scroll(function() { //detect page scroll
        if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
            if($('#load_more_posts').data('url')!==undefined){
                loadMorePosts($('#load_more_posts').data('url'))
            }
        }
    });
    $(document).on('click', '.add_publication', function (e){
        e.preventDefault();
        $('.error.text-danger').remove();
        const block = $(this).parents('form.modal-content');
        axios.post('/posts/add_post', {
            author: $(this).parents('form.modal-content').find('input[name="author"]').val(),
            title: $(this).parents('form.modal-content').find('input[name="title"]').val(),
            text: $(this).parents('form.modal-content').find('.note-editable.card-block').html()
        })
        .then(function () {
            location.reload()
        })
        .catch(function (error) {
            console.log(error);
            if(error.response.status===422){
                for (let key in error.response.data) {
                    $(block).find('[name="'+key+'"]').after('<div class="error text-danger">'+error.response.data[key][0]+'</div>')
                }
            }
        });
    })
    $(document).on('click', '.delete_picture_button', function (e){
        e.preventDefault();
    })
    $(document).on('click', '.delete_post_picture_button', function (e){
        e.preventDefault();
    })
    $(document).on('change', '[name="files[]"]', function (e){
        uploadFile($(this).data('user-id'), this.files[0], 0, $(this).data('post-id'));
    });
    $(document).on('change', '[name="typePost"]', function (e){
        displayCheckTab()
    });
    $(document).on('change', '[name="video"]', function (e){
        setLoadingSpinner('.video_preview')
        $('.video_preview').empty().html('<div id="player"></div>')
        let code = ''
        try {
            let URLObject = new URL($(this).val())
            const urlParams = new URLSearchParams(URLObject.search);
            code = urlParams.get('v')
            if(!code&&URLObject.hostname==='youtu.be') {
                code = URLObject.pathname.replace('/', '');
            }
            initPlayer('player', code)
        }catch (e){
            initPlayer('player', $(this).val())
        }
    });
    $(document).on('click', '.confirm_delete_image', function (e){
        e.preventDefault();
        //setLoadingSpinner('.unused_images_block');
        var form = $(this).parents('.form-modal');
        $(this).parent('.modal-footer').find('.decline_delete_image').trigger('click')
        axios.delete('/delete_image_ui', {
            data: {
                key: $(form).find('[name="id"]').val(),
                _token: $(form).find('[name="_token"]').val(),
            }
        })
        .then(function (html) {
            $('.unused_images_block').empty().html(html.data)
        })
        .catch(function (error) {
        });
    })
    $(document).on('click', '.like-button', function (e){
        e.preventDefault();
        let action = $(this).data('action')
        let entity = $(this).data('entity')
        const id = $(this).data('id');
        axios.post('/posts/like', {
            action: action,
            entity: entity,
            id: id,
        })
        .then(function (response) {
            if(response.data.success) {
                if(entity==='post')
                    getMeta(id)
                else
                    getComentMeta(id)
            }
        })
        .catch(function (error) {
            if(error.response.status===401){
                showUnAuthorizedWindow()
            }
        });
    })
    $(document).on('click', '.inbox.chat-message-send', function (e){
        e.preventDefault();
        var form = $(this).parent('form.chat-text-field');
        var id = $(this).data('thread');
        let formData = new FormData(form[0]);
        if(formData.get('message').length>0) {
            axios.post($(form).attr('action'), formData)
                .then(function (response) {
                    $('.live-chat-field[name="message"]').val('');
                    updateChatMessages(id);
                });
        }
    })
    $(document).on('click', '.confirm_delete_post_image', function (e){
        e.preventDefault();
        //setLoadingSpinner('.unused_images_block');
        var form = $(this).parents('.form-modal');
        $(this).parent('.modal-footer').find('.decline_delete_post_image').trigger('click');

        axios.delete('/delete_image_ui', {
            data: {
                by_post: true,
                key: $(form).find('[name="id"]').val(),
                post: $(form).find('[name="post"]').val(),
                _token: $(form).find('[name="_token"]').val(),
            }
        })
        .then(function (html) {
            $('.unused_images_block').empty().html(html.data)
        })
        .catch(function (error) {
        });
    })
    $(document).on('submit', '.delete_comment_action', function (e){
        e.preventDefault();
        if (confirm()) {
            const formData = new FormData($(this)[0]);
            axios.delete($(this).attr('action'), {
                data: formData
            }).then(function (response) {
                if (parseInt(response.data.id) > 0) {
                    $('.comment-block[data-coment-id="' + parseInt(response.data.id) + '"]').replaceWith("<div class='alert-success p-4 m-3 border-success border success_delete_coment' data-coment-id='" + response.data.id + "'>Komentarz pomyślnie usunięty</div>");
                    setTimeout(function () {
                        $('.success_delete_coment[data-coment-id="' + response.data.id + '"]').remove();
                    }, 5000);
                }
            });
        }
    })
    $(document).on('click', '.subscribe_request', function (e){
        e.preventDefault();
        let button = $(this);
        let action = "unsubscribe";
        let community_id = $(this).data('community')
        if($(button).hasClass('subscribe'))
            action = "subscribe";
        axios.post($(this).data('url'), {
            data: {
                user_id: $(this).data('user'),
                community_id: community_id,
                action: action,
                _token: $('meta[name="token"]').attr('content')
            }
        }).then(function (response) {
            if(response.data.success){
                getGroupMainInfo(community_id)
            }
        });
    });
    $(document).on('click', '.subscribe_request_list', function (e){
        e.preventDefault();
        let button = $(this);
        let action = "unsubscribe";
        let community_id = $(this).data('community')
        if($(button).hasClass('subscribe'))
            action = "subscribe";
        axios.post($(this).data('url'), {
            data: {
                user_id: $(this).data('user'),
                community_id: community_id,
                action: action,
                _token: $('meta[name="token"]').attr('content')
            }
        }).then(function (response) {
            if(response.data.success){
                if(action=='subscribe'){
                    $(button).removeClass('subscribe').addClass('unsubscribe').text('Opuść grupę');
                }else{
                    $(button).removeClass('unsubscribe').addClass('subscribe').text('Dołącz do grupy');
                }
            }
        });
    });
    $(document).on('submit', '.delete_comment_action', function (e){
        e.preventDefault();
        if (confirm()) {
            const formData = new FormData($(this)[0]);
            axios.delete($(this).attr('action'), {
                data: formData
            }).then(function (response) {
                if (parseInt(response.data.id) > 0) {
                    $('.comment-block[data-coment-id="' + parseInt(response.data.id) + '"]').replaceWith("<div class='alert-success p-4 m-3 border-success border success_delete_coment' data-coment-id='" + response.data.id + "'>Komentarz pomyślnie usunięty</div>");
                    setTimeout(function () {
                        $('.success_delete_coment[data-coment-id="' + response.data.id + '"]').remove();
                    }, 5000);
                }
            });
        }
    })
    $(document).ready(function() {
        $('.live-chat-field[name="message"]').keyup(function(e) {
            if (e.which === 13){
                e.preventDefault();
                $('.inbox.chat-message-send').trigger('click')
            }
        });
    });
    $('.note-video-clip').each(function(){
        var tmp = $(this).wrap('<p/>').parent().html();
        $(this).parent().html('<div class="embed-responsive embed-responsive-16by9">'+tmp+'</div>');
    });
    $(document).on('dragover', '#drop_zone', false).on('drop', '#drop_zone', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if(e.originalEvent.dataTransfer.files.length<=$(this).data('max')){
                for (let i = 0; i<=e.originalEvent.dataTransfer.files.length; i++)
                    uploadFile($(this).data('user-id'), e.originalEvent.dataTransfer.files[i], i);
            }else{
                alert('max 4 images')
            }

        });
    $(document).on('dragover', '#drop_zone_post', false).on('drop', '#drop_zone_post', function (e) {
            e.preventDefault();
            e.stopPropagation();
            if(e.originalEvent.dataTransfer.files.length<=$(this).data('max')){
                for (let i = 0; i<=e.originalEvent.dataTransfer.files.length; i++)
                    uploadFile($(this).data('user-id'), e.originalEvent.dataTransfer.files[i], i, $(this).data('post-id'));
            }else{
                alert('max 4 images')
            }

        });
    $('.youtube_player').each(function (i, elem){
        let block = $(elem).parent('.video')
        $(block).css('height', $(block).width()*0.57);
        initPlayer($(elem).attr('id'), $(elem).data('code'))
    })
    if($('input#video').length&&$('input#video').val()!='') {
        try {
            let URLObject = new URL($('input#video').val())
            const urlParams = new URLSearchParams(URLObject.search);
            code = urlParams.get('v')
            if(!code&&URLObject.hostname==='youtu.be') {
                code = URLObject.pathname.replace('/', '');
            }
            initPlayer('player', code)
        }catch (e){
            initPlayer('player', $('input#video').val())
        }
    }
})




function initPlayer(selector, code){
    let p_la = new YT.Player(selector, {
        videoId: code,
    });
}
function loadMorePosts(url){
    axios.get(url, {

    })
    .then(function (html) {
        $('#load_more_posts').remove();
        $('.posts_block').append(html.data);
        $(".img-popup").lightGallery();

        // light gallery images
        $(".img-gallery").lightGallery({
            selector: ".gallery-selector",
            hash: false
        });
        $('.youtube_player').each(function (i, elem){
            if ($(elem).html().trim() === ''){
                let block = $(elem).parent('.video')
                $(block).css('height', $(block).width()*0.57);
                initPlayer($(elem).attr('id'), $(elem).data('code'))
            }
        })
    })
}
function displayCheckTab(){
    $('.check_box_block').css('display', 'none')
    $('.'+$('[name="typePost"]:checked').val()+'_block').css('display', 'block')
}
function getComentMeta(coment_id){
    axios.post('/posts/getMeta', {
        id: coment_id,
        entity: 'coment',
    })
        .then(function (html) {
            $('.comments-meta-block[data-id="'+coment_id+'"]').empty().html(html.data)
        })
}
function getGroupMainInfo(group_id){
    axios.post('/groups/getMeta', {
        id: group_id,
    })
        .then(function (html) {
            $('#main_group_block').empty().html(html.data)
        })
}
function updateChatMessages(thread_id){
    if((parseInt($(".message-list-inner .message-list.my-scroll")[0].scrollHeight)-parseInt($(".message-list-inner .message-list.my-scroll")[0].scrollTop))===280){
        axios.post('/inbox/getThreadAjax', {
            id: thread_id,
        }).then(function (html) {
            $('.inb.message-list-inner').empty().html(html.data)
            $(".message-list-inner .message-list.my-scroll").scrollTop($(".message-list-inner .message-list.my-scroll")[0].scrollHeight)
        })
    }
}
function getMeta(post_id){
    axios.post('/posts/getMeta', {
        id: post_id,
    })
    .then(function (html) {
        $('.post-meta.post-meta-block[data-id="'+post_id+'"]').empty().html(html.data)
    })
}
/*
function uploadFile(user_id, file, post=null){
    let formData = new FormData();
    formData.append('user', user_id)
    if(file.length>0){
        for (let x = 0; x < file.length; x++) {
            formData.append("picture[]", file[x]);
        }
    }
    console.log(formData.get('picture[]'));
    axios.post('/store_image_ui', formData)
        .then(function (html) {
            $('.unused_images_block').empty().html(html.data)
        })
        .catch(function (error) {
        });
}
*/
// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
    //event.target.playVideo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING && !done) {
        setTimeout(stopVideo, 6000);
        done = true;
    }
}
function stopVideo() {
    player.stopVideo();
}
function uploadFile(user_id, file, key= 0, post=null){
    let formData = new FormData();
    formData.append('user', user_id)
    formData.append("picture", file);
    formData.append("number", key);
    if(post)
        formData.append("post", post);
    setLoadingSpinner('.unused_images_block');
    axios.post('/store_image_ui', formData)
        .then(function (html) {
            $('.unused_images_block').empty().html(html.data)
        })
        .catch(function (error) {
        });
}
function setLoadingSpinner(selector){
    let block = '<div class="w-100 text-center">' +
        '<div class="spinner-border text-primary" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div>' +
        '</div>';
    $(selector).empty().html(block);
}
function showUnAuthorizedWindow(){
    $('#custom_modal').css('top', '25%')
    $('#custom_modal').find('.modal-title').empty().html('Nie jesteś upoważniony')
    $('#custom_modal').find('.modal-body').empty().html('Nie jesteś upoważniony! Kliknij <a href="/login">łącze</a>, aby uzyskać autoryzację')
    $('.custom_modal_button').trigger('click')
}

