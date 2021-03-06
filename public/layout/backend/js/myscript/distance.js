function addDistanceForm() {
    save_method = "add";
    $('input[name=_method]').val('POST');
    $('#modal-form').modal('show');
    $('#modal-form #form-distance')[0].reset();
    $("#modal-form #form-distance").find('.help-block').remove();
    $("#modal-form #form-distance").find('.form-group').removeClass('has-error');
    $('.modal-title').text('Thêm mới');
    $('.btn-save').text('Thêm mới');
}
function refresh() {
    distances_table.ajax.reload();
}

function editDistanceForm(id) {
    save_method = "edit";
    $('#modal-form #form-distance')[0].reset();
    $("#modal-form #form-distance").find('.help-block').remove();
    $("#modal-form #form-distance").find('.form-group').removeClass('has-error');
    $('input[name=_method]').val('PATCH');
    $('.btn-save').text('Chỉnh sửa');
    $.ajax({
        type: "get",
        url: base_url + "/admin/distances/" + id + "/edit",
        data: $("#modal-form #form-distance").serialize(),
        dataType: "json",
        success: function (data) {
            $('#modal-form').modal('show');
            $("#id").val(data.id);
            $("#name").val(data.name);
            $('.modal-title').text('Chỉnh sửa');
        },
        error: function (xhr) {
            var res = xhr.responseJSON;
            if (res.message) {
                alert(res.message);
            }else{
                alert("Error!!")
            }
        }
    });
}
$(document).ready(function () {
    $("#modal-form #form-distance").submit(function (e) {
        e.preventDefault();

        $(this).find('.help-block').remove();
        $(this).find('.form-group').removeClass('has-error');

        var id = $("#id").val();
        if (save_method == 'add') {
            url = base_url + "/admin/distances";
        }else{
            url = base_url + "/admin/distances/" + id;
        }

        $.ajax({
            type: "post",
            url: url,
            data: $(this).serialize(),
            success: function (data) {
                distances_table.draw(false);
                $("#modal-form").modal("hide");
                toastr.success(data)
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) === false) {
                    $.each(res.errors,function (key,value) {
                        $("#"+key).closest(".form-group")
                                    .addClass("has-error")
                                    .append('<strong class="help-block with-errors">'+value+'</strong>');
                    })
                }
            },
        });
    });
});

function deleteDistanceData(id) {
    var csrf_token = $("meta[name='csrf-token']").attr('content');
    if (confirm('Bạn có chắc là muốn xóa?')) {
        $.ajax({
            type: "post",
            url: base_url + "/admin/distances/"+ id ,
            data: {
                '_method' : "DELETE",
                '_token' : csrf_token
            },
            success: function (data) {
                toastr.success(data);
                distances_table.draw(false);
            },
            error: function (xhr) {
                var res = xhr.responseJSON;
                if (res.message) {
                    alert(res.message);
                }else{
                    alert("Error!!")
                }
            }
        });
    }else{
        return false;
    }
}
