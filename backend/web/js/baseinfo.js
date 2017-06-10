$(document).ready(
  $('#province-form').on('beforeSubmit', function(event, jqXHR, settings) {
var form = $(this);
if(form.find('.has-error').length) {
        return false;
}

$.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
          $('#province-name').val("");
          $.pjax.reload({container: '#province_pjax'});
          $( ".province-log" ).text( "عملیات با موفقیت انجام شد!" );
        }
});

return false;
})
  );



  $(document).ready(
    $('#city-form').on('beforeSubmit', function(event, jqXHR, settings) {
  var form = $(this);
  if(form.find('.has-error').length) {
          return false;
  }

  $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function(data) {
            $('#city-name').val("");
            $.pjax.reload({container: '#city_pjax'});
            $( ".city-log" ).text( "عملیات با موفقیت انجام شد!" );
          }
  });

  return false;
  })
    );

    $(document).ready(
      $('#region-form').on('beforeSubmit', function(event, jqXHR, settings) {
    var form = $(this);
    if(form.find('.has-error').length) {
            return false;
    }

    $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(data) {
              $('#region-name').val("");
              $.pjax.reload({container: '#region_pjax'});
              $( ".region-log" ).text( "عملیات با موفقیت انجام شد!" );
            }
    });

    return false;
    })
      );

$(document).ready(
        $('#my-form').on('beforeSubmit', function(event, jqXHR, settings) {
                var form = $(this);
                if(form.find('.has-error').length) {
                        return false;
                }

                $.ajax({
                        url: form.attr('action'),
                        type: 'post',
                        data: form.serialize(),
                        success: function(data) {
                          $('#dealingtype-name').val("");
                          $.pjax.reload({container: '#dealing_type_pjax'});
                          $( ".log" ).text( "عملیات با موفقیت انجام شد!" );
                        }
                });

                return false;
        })
  );

  $(document).ready(
    $('#view-form').on('beforeSubmit', function(event, jqXHR, settings) {
  var form = $(this);
  if(form.find('.has-error').length) {
          return false;
  }

  $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function(data) {
            $('#propertyview-name').val("");
            $.pjax.reload({container: '#view_pjax'});
            $( ".view-log" ).text( "عملیات با موفقیت انجام شد!" );
          }
  });

  return false;
})
    );

    $(document).ready(
      $('#cover-form').on('beforeSubmit', function(event, jqXHR, settings) {
    var form = $(this);
    if(form.find('.has-error').length) {
            return false;
    }

    $.ajax({
            url: form.attr('action'),
            type: 'post',
            data: form.serialize(),
            success: function(data) {
              $('#floorcovering-name').val("");
              $.pjax.reload({container: '#cover_pjax'});
              $( ".cover-log" ).text( "عملیات با موفقیت انجام شد!" );
            }
    });

    return false;
  })
      );

      $(document).ready(
        $('#cabinet-form').on('beforeSubmit', function(event, jqXHR, settings) {
      var form = $(this);
      if(form.find('.has-error').length) {
              return false;
      }

      $.ajax({
              url: form.attr('action'),
              type: 'post',
              data: form.serialize(),
              success: function(data) {
                $('#cabinet-name').val("");
                $.pjax.reload({container: '#cabinet_pjax'});
                $( ".cabinet-log" ).text( "عملیات با موفقیت انجام شد!" );
              }
      });

      return false;
    })
        );

        $(document).ready(
          $('#vila-form').on('beforeSubmit', function(event, jqXHR, settings) {
        var form = $(this);
        if(form.find('.has-error').length) {
                return false;
        }

        $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function(data) {
                  $('#vilatype-name').val("");
                  $.pjax.reload({container: '#vila_pjax'});
                  $( ".vila-log" ).text( "عملیات با موفقیت انجام شد!" );
                }
        });

        return false;
      })
          );

          $(document).ready(
            $('#facilities-form').on('beforeSubmit', function(event, jqXHR, settings) {
          var form = $(this);
          if(form.find('.has-error').length) {
                  return false;
          }

          $.ajax({
                  url: form.attr('action'),
                  type: 'post',
                  data: form.serialize(),
                  success: function(data) {
                    $('#facilities-name').val("");
                    $.pjax.reload({container: '#facilities_pjax'});
                    $( ".facilities-log" ).text( "عملیات با موفقیت انجام شد!" );
                  }
          });

          return false;
        })
            );

$(document).ready(function() {
$('.collapse.in').prev('.panel-heading').addClass('active');
$('#accordion, #bs-collapse')
.on('show.bs.collapse', function(a) {
  $(a.target).prev('.panel-heading').addClass('active');
})
.on('hide.bs.collapse', function(a) {
  $(a.target).prev('.panel-heading').removeClass('active');
});
});
