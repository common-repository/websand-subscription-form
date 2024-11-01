jQuery(".websand-subscription-form").submit(function(event){
  if (jQuery(this).find("input#wshq_subscribe_confirmation").is(":checked")) {
    window.open(jQuery(this).find("input#wshq_redirect").val());

    jQuery.ajax({
      url: "https://" + jQuery(this).find("input#wshq_domain").val() + ".websandhq.com/api/data/subscriber",
      type: "POST",
      beforeSend: function(xhr) {
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Authorization", "Token " + jQuery('.websand-subscription-form').find("input#wshq_subscribe_key").val());
      },
      data: JSON.stringify({
        subscriber: {
          first: jQuery(this).find("input#wshq_subscriber_first").val(),
          email: jQuery(this).find("input#wshq_subscriber_email").val(),
          source: jQuery(this).find("input#wshq_source").val(),
          confirmed: 'true',
          subscribed_at: new Date(jQuery.now()).toISOString()
        }
      }),
      success: function(data, textStatus, jqXHR) {
              jQuery('.websand-subscription-form')[0].reset();
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
      }
    });
  } else {
    jQuery(this).find("input#wshq_confirmation").css({
      "border-color": "#F00",
      "border-width":"2px",
      "border-style":"solid"
    });
  }

  event.preventDefault();
})