jQuery(document).ready(function ($) {
  /*
   * Загрузка изображений на странице редактирования товара
   */
  $('.upload_image_button').click(function () {
    var send_attachment_bkp = wp.media.editor.send.attachment
    var button = $(this)
    wp.media.editor.send.attachment = function (props, attachment) {
      $(button).parent().prev().attr('src', attachment.url)
      $(button).prev().val(attachment.id)
      wp.media.editor.send.attachment = send_attachment_bkp
    }
    wp.media.editor.open(button)
    return false
  })

  /*
   * Удаление изображения
   */
  $('.remove_image_button').click(function () {
    var r = confirm('Delete image?')
    if (r == true) {
      var items = $('.images_item')
      if (items.length == 1) {
        var src = $(this).parent().prev().attr('data-src')
        $(this).parent().prev().attr('src', src)
        $(this).prev().prev().val('')
      } else {
        $(this).closest('.images_item').remove()
      }
    }
    setIndex()
    return false
  })

  /*
   * Добавление поля для добавления нового изображения
   */
  $('#add_load').on('click', function (e) {
    e.preventDefault()
    var wrap = $('.images')
    var items = $('.images_item')
    var noImg = $('#noImg').val()
    var item = items.last()
    var newItem = item.clone(true)
    var inputHidden = newItem.find('input[type="hidden"]')
    var imgItem = newItem.find('img.img_item')
    inputHidden.val('')
    imgItem.attr('data-src', noImg)
    imgItem.attr('src', noImg)

    wrap.append(newItem)
    setIndex()
  })
  /*
   * Функция установки ключей для полей name
   */
  function setIndex() {
    var fieldImg
    $('.images_item').each(function (index, el) {
      fieldImg = $(el).find('.field_img_id')
      fieldImg.attr('name', 'images[' + (index + 1) + ']')
      fieldImg.attr('id', 'images[' + (index + 1) + ']')
    })
  }

  /*
   * Добавление поля в списке
   */
  $('#add_list_input').on('click', function (e) {
    e.preventDefault()
    var wrap = $('.list_input')
    var items = $('.list_input__item')

    var item = items.last()
    var newItem = item.clone(true)
    newItem.find('input[type="text"]').val('')

    wrap.append(newItem)
    // setIndex()
  })

  /*
   * Удаление поля в списке
   */
  $('.delete_input').on('click', function (e) {
    var r = confirm('Delete item?')
    if (r == true) {
      var items = $('.list_input__item')
      if (items.length == 1) {
      } else {
        $(this).closest('.list_input__item').remove()
      }
    }
    // setIndex()
    return false
  })

  ///get map coordinate
  let buttonGet = document.getElementById('property_address_for_map')
  if(buttonGet.value.length>0){
    document.getElementById('get_map_coordinate').style.display= 'block'
  }else{
    document.getElementById('get_map_coordinate').style.display= 'none'
  }
  if(buttonGet){
    buttonGet.addEventListener('input',(e)=>{
      if(buttonGet.value.length>0){
document.getElementById('get_map_coordinate').style.display= 'block'
      }else{
        document.getElementById('get_map_coordinate').style.display= 'none'
      }
    })
  }
  $('#get_map_coordinate').on('click', function (e) {
    //console.log(" value "+document.getElementById('property_address_for_map').value)

    let address1 = document.getElementById('property_address_for_map').value
    let address = address1.replace(/ /g, '+');
    //console.log(address+' | start address= '+address1)
    if(address !="") {

      fetch(`https://maps.google.com/maps/api/geocode/json?address=${address}&key=KEY`)
          .then(response => response.json())
          .then((commits) => {
            //console.log(commits)
            let coordinates = commits.results[0].geometry.location
            let latitude = coordinates.lat
            let longitude = coordinates.lng
            //console.log("lat = " + latitude + " | lng = " + longitude)
            document.getElementById('acf-field_6165411b7e723-field_6165419378979').value = latitude
            document.getElementById('acf-field_6165411b7e723-field_616541dc7897a').value = longitude
          })
          .catch(() => alert("Error! Can't get the property coordinate." ))
    }


  })

})


