$( document ).ready ->
  $('.product .amount').bind 'input', ->
    parent = $(this).parent()
    label = $('label', parent)
    amount = $(this).val()
    productPrice = $(label).data().value
    sum = $('.sum', parent)
    price = parseFloat(Math.round(amount * productPrice * 100) / 100).toFixed(2)
    sum.val(price)
    calculateTotalValue()

  numberInput = $('input[type=number]')
  numberInput.keydown (e) ->
    return false unless ((e.keyCode > 95 && e.keyCode < 106) or (e.keyCode > 47 && e.keyCode < 58) or e.keyCode == 8)


calculateTotalValue = ->
  sum = 0
  $('.product').each ->
    sum += ($('.amount', this).val() * $('label', this).data().value)
  total = $('.total input')
  sum = parseFloat(Math.round(sum * 100) / 100).toFixed(2)
  total.val sum

  $('input[name=total]').val sum

  if sum > 0
    $('#customButton').prop('disabled', false)
  else
    $('#customButton').prop('disabled', true)
