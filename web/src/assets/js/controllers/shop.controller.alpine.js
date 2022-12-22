// SHOP CONTROLLER

document.addEventListener("alpine:init", () => {
  Alpine.data("shopController", () => ({
    // DATA
    products: [],
    cart: [],

    // METHODS
    async init() {
      console.log(location.hostname);
      // Get all products when page loads
      await this.getProducts();
      // Get all products in cart when page loads
      await this.getCartItems();
    },

    async getProducts() {
      // Send a request to the server to fetch products
      const productResult = await axios.post(
        "./../../server/controllers/products/endpoint.product.php",
        {
          getproduct: "all",
        }
      );

      console.log("[PRODUCTS]: ", productResult.data);

      if (productResult.data.success == true) {
        this.products = productResult.data.data;
      }
    },

    async getCartItems() {
      const user = JSON.parse(localStorage.getItem("customerData"));

      // Send a request to the server to fetch products in cart
      const cartResult = await axios.post(
        "./../../server/controllers/cart/endpoint.cart.php",
        {
          getCartItems: user.customer_ID,
        }
      );

      console.log("[CART]: ", cartResult.data);

      if (cartResult.data.success == true) {
        this.cart = cartResult.data.data;
      }
    },

    filterProducts(product_ID) {
      return this.products.filter(
        (product) => product.product_ID == product_ID
      );
    },

    async increaseQuantity() {
      this.cart.quantity++;

      await this.updateCartItemQty(this.cart)
     
      
    },

    async updateCartItemQty(cart){

      const user = JSON.parse(localStorage.getItem("customerData"));
      // Send a request to the server to update products in cart
      const updateCartItemQtyResult = await axios.post(
        "./../../server/controllers/cart/endpoint.cart.php",
        {
          updateCartQty:{
            customer_ID: user.customer_ID,
            product_ID: cart.product_ID,
           quantity: cart.quantity
          }

        })

        console.log(updateCartItemQtyResult.data)

        if(updateCartItemQtyResult.data.success == true){
          
        }
    },

    async decreaseQuantity() {
      if (this.cart.quantity > 1) {
        this.cart.quantity--;
        await this.updateCartItemQty(this.cart)
      }

    },

    async deleteProduct(index) {
      const user = JSON.parse(localStorage.getItem("customerData"));
      // Send a request to the server to fetch products in cart
      const deleteProductResult = await axios.post(
        "./../../server/controllers/cart/endpoint.cart.php",
        {
          deleteCartItem: {
            customerId: user.customer_ID,
            productId: this.cart.product_ID,
          },
        }
      );
      console.log(deleteProductResult);

      if(deleteProductResult.data.success == true){
        window.location.reload()
      }
    },

    calculateTotal() {
      
      if (this.cart.length > 0)
        return this.cart.reduce((total, cartItem) => {
          return total + cartItem.quantity * this.filterProducts(cartItem.product_ID)[0].unit_price;
        }, 0);

      return 0;

     
    },

    async addToCart(product_ID){
      console.log("PRODUCT ID: ", product_ID)
      const user = JSON.parse(localStorage.getItem("customerData"));
      // Send a request to the server to fetch products in cart
      const addToCartResult = await axios.post(
        "./../../server/controllers/cart/endpoint.cart.php",

        {
          addToCart: {
          customer_ID: user.customer_ID,
          product_ID: product_ID,
          quantity: 1

          }
           

        }
        
      );

    if (addToCartResult.data.success == true){
      alert("Product added to cart.");
    }

    },

    async makePayment(){
      const user = JSON.parse(localStorage.getItem("customerData"));
      var handler = PaystackPop.setup({
        key:  'pk_live_bd5356607a881f3a0d6843b75d3172b74b9675cd', // Replace with your public key
        email: user.email,
        amount : 1 * 100,
        // amount: (this.calculateTotal() * 100), // the amount value is multiplied by 100 to convert to the lowest currency unit
        currency: 'GHS', // Use GHS for Ghana Cedis or USD for US Dollars
        ref: `LT-${Date.now()}`, // Replace with a reference you generated
        callback: function(response) {
          //this happens after the payment is completed successfully
          var reference = response.reference;
          alert('Payment complete! Reference: ' + reference);
          // Make an AJAX call to your server with the reference to verify the transaction
        },
        onClose: function() {
          alert('Transaction was not completed, window closed.');
        },
      });
      handler.openIframe();
    }


  }));

  
  
});
