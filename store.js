
window.onload = function(){
   
   
    var productsContainer=[];
 var j=0;
     displaycart();
     function displaycart(){
 
      var cartRow = document.createElement('div')
      cartRow.classList.add('row')
      
      var cartItems = document.getElementsByClassName('cart-row')[0]
      var cartItemNames = cartItems.getElementsByClassName('card-title')
  
 
 
 
         if(localStorage.getItem('products')){
 
             
             let cartproducts = JSON.parse(localStorage.getItem('products'))
             console.log('the length', cartproducts.length)
            
             Object.values(cartproducts).map(item=>{
                 addItemToCart(item.name, item.cost, item.image)
             });
   
     updateCartTotal();
 
         }
     
    
  
  var removeCartItemButton = document.getElementsByClassName("btn-danger")
  console.log(removeCartItemButton.length);
  for ( var i=0; i<removeCartItemButton.length; i++){
      var button = removeCartItemButton[i] ;
     
      button.addEventListener('click' , removeCartItem)
      
      }
      var quantityInput = document.getElementsByClassName('cart-quantity-input')
      for( var i=0; i<quantityInput.length; i++)  {
          var input= quantityInput[i]
          input.addEventListener('change', quantityChanged)
      } 
      
      var addToCartButton = document.getElementsByClassName("shop-item-button")
      for (var i =0; i< addToCartButton.length; i++){
          var button = addToCartButton[i]
          
          button.addEventListener('click', addToCartClicked)
          
      
          
  
      }
  
     
  function removeCartItem(event){
      var buttonclicked = event.target
      
      buttonclicked.parentElement.parentElement.remove()
      removeFromStorage(buttonclicked)
      updateCartTotal()
      
  
  }
 
  function removeFromStorage(button){
     var button = event.target
     var itemremoving = button.parentElement.parentElement
     console.log('item class', itemremoving)
    
     var cartItems = itemremoving.getElementsByClassName('cart-item-title')[0].innerText
 
     
     console.log('name of the item', cartItems)
     var inarray = JSON.parse(localStorage.getItem('products'))
     for(var i=0; i<inarray.length;i++){
        
        console.log(inarray[i].name)
     if(inarray[i].name==cartItems){
         inarray.splice(i, 1);
         console.log(inarray)
         localStorage.setItem('products', JSON.stringify (inarray))
     }
 }
 return;
 
  }
  function quantityChanged(event){
      var input = event.target
      if(isNaN(input.value)||input.value<=0){
          input.value = 1
      }
          updateCartTotal()
      
  
  
  }
  
 
  
  function addToCartClicked (button){
      
      var button = event.target
      var shopItem = button.parentElement.parentElement
      console.log(shopItem)
      var title = shopItem.getElementsByClassName('card-title')[0].innerText
       //console.log('thi', typeof(shopItem.getElementsByClassName("card-img-top")[0].src ))
       var price =  shopItem.getElementsByClassName('cost')[0].innerText
       var imageSrc = shopItem.getElementsByClassName("card-img-top")[0].src
       console.log(imageSrc)

     
       let listproduct ={name: title, cost: price, image: imageSrc};
            if(localStorage.getItem('products')){
          productsContainer = JSON.parse(localStorage.getItem('products'));
          productsContainer.push(listproduct)
          localStorage.setItem('products', JSON.stringify(productsContainer))
     
      }
      else{
         productsContainer = [{name: title, cost: price, image: imageSrc}]
          localStorage.setItem('products', JSON.stringify(productsContainer))
      } 
       
      
    
      addItemToCart(title, price, imageSrc)
      updateCartTotal()
      
      
      
      
      
      
  
  }
  
  function addItemToCart(title, price, image){
      var cartRow = document.createElement('div')
      cartRow.classList.add('row')
      
      var cartItems = document.getElementsByClassName('cart-row')[0]
      var cartItemNames = cartItems.getElementsByClassName('card-title')
  
      var cartRowContent = `   
      <div class="col-md-4">
          <img class="cart-item-image" src=${image} width="100" height="100">
          <span class="cart-item-title">${title}</span>
      </div>
      <div class="col-md-4 cart-price"> ${price}</div>
      <div class="col-md-4"> <input class="cart-quantity-input " type="number" value="3">
          <button class="btn btn-danger" type="button">REMOVE</button> <!--remove button--></div>
  `
      cartRow.innerHTML=cartRowContent
      cartItems.append(cartRow)
      cartRow.getElementsByClassName('btn-danger')[0].addEventListener('click', removeCartItem)
      cartRow.getElementsByClassName('cart-quantity-input')[0].addEventListener('change', quantityChanged)
  }
  
  
  function updateCartTotal(){
      var cartItemContainer = document.getElementsByClassName('cart-row')[0]
      var cartRows = cartItemContainer.getElementsByClassName('row')
      console.log(cartRows.length)
      var total=0
      for(var i =0; i<cartRows.length; i++){
          var cartRow = cartRows[i]
          var priceElement = cartRow.getElementsByClassName('cart-price')[0]
          var quantityElement = cartRow.getElementsByClassName('cart-quantity-input')[0]
          var price=priceElement.innerText.replace ('$', '')
          var quantity=quantityElement.value
          total = total + (price*quantity);
          console.log(total)
      }
      total = Math.round(total*100)/100
      document.getElementsByClassName('total-price')[0].innerText = '$' + total
  
  
  }
  
  }
 }
  
  
  
    
  
  
  
  
  