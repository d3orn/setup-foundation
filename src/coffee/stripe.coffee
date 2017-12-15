$('.spinner').hide()

handler = StripeCheckout.configure(
  key: 'pk_test_jO4BvaQpjfWOPpWMfPgHgisi'
  image: '/img/oxon.png'
  locale: 'auto'
  token: (token) ->
    $form = $('#payment-form')
    $form.append $('<input type="hidden" name="stripeToken" />').val(JSON.stringify(token))

    $('.spinner').show()
    $form.get(0).submit()
    return
)

$('#customButton').on 'click', (e) ->
  handler.open
    name: 'Super Shorts'
    description: ''
    currency: 'chf'
    amount: 2000
    image: "/img/oxon.png"
    locale: "auto"
    billingAddress: true
    panelLabel: 'Jetzt bestellen ({{amount}})'
    continue: 'test'

  e.preventDefault()
  return

$(window).on 'popstate', ->
  handler.close()
  return
