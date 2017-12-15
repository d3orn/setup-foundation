$('.overlay').hide()

handler = StripeCheckout.configure(
  key: 'pk_test_jO4BvaQpjfWOPpWMfPgHgisi'
  locale: 'auto'
  token: (token) ->
    $form = $('#payment-form')
    $form.append $('<input type="hidden" name="stripeToken" />').val(JSON.stringify(token))

    $('.overlay').show()
    $form.get(0).submit()
    return
)

$('#customButton').on 'click', (e) ->
  handler.open
    name: 'Tickets kaufen'
    description: ''
    currency: 'chf'
    amount: parseInt($('.total input').val()) * 100
    image: "css/images/logo.png"
    locale: "auto"
    billingAddress: true
    panelLabel: 'Jetzt bestellen ({{amount}})'

  e.preventDefault()
  return

$(window).on 'popstate', ->
  handler.close()
  return
