function loginDataAlpineWrapper() {
   

  return {

     //   DEFAULT
    
     toggleTheme() {
       this.dark = !this.dark;
      
     },
     isSideMenuOpen: false,
     toggleSideMenu() {
       this.isSideMenuOpen = !this.isSideMenuOpen;
     },
     closeSideMenu() {
       this.isSideMenuOpen = false;
     },
     isNotificationsMenuOpen: false,
     toggleNotificationsMenu() {
       this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
     },
     closeNotificationsMenu() {
       this.isNotificationsMenuOpen = false;
     },
     isProfileMenuOpen: false,
     toggleProfileMenu() {
       this.isProfileMenuOpen = !this.isProfileMenuOpen;
     },
     closeProfileMenu() {
       this.isProfileMenuOpen = false;
     },
     isPagesMenuOpen: false,
     togglePagesMenu() {
       this.isPagesMenuOpen = !this.isPagesMenuOpen;
     },
     // Modal
     isModalOpen: false,
     trapCleanup: null,
     openModal() {
       this.isModalOpen = true;
       this.trapCleanup = focusTrap(document.querySelector("#modal"));
 
       // Load the Customers
       this.getCustomers()
     },
     trick() {
       console.log("Treat");
     },
     closeModal() {
       this.isModalOpen = false;
       this.trapCleanup();
     },
     // end of DEFAULT

    // LOGIN
    isPasswordValid: null,
    isEmailValid: null,
    loginErrorMessage: "",
    usersErrorMessage: "",
    customer : [],
    customerData: {
      email: "",
      password: document.getElementById("passwordField")?.value,
    },
    storeCustomerData(customerData) {
      localStorage.setItem("customerData", JSON.stringify(customerData));
    },
    currentUser: JSON.parse(localStorage.getItem("customerData")),
    getCustomerData(){
      this.customerData = JSON.parse(localStorage.getItem("customerData"))
    },
    clearErrors() {
      this.isPasswordValid = null;
      this.isEmailValid = null;
      this.loginErrorMessage = "";
    },
    async login() {
      // Clear all errors
      this.clearErrors();

      
      // Send a request to the server to login user.
      const loginResult = await axios.post("./../../server/controllers/auth/endpoint.auth.php", {
          "login" : this.customerData
        });



      // If the login fails, show the error message
      if (!loginResult.data.success)
        return (this.loginErrorMessage = loginResult.data.error.message);

      // else, store customer data and move to the dashboard
      this.storeCustomerData(loginResult.data.data);

      if(loginResult.data.data.role == 1) return location.href = "./../";

        
      location.href = "shop.html";
    },

    // async getAllCustomers() {
      
    //   // Send a request to the server to login customer.
    //   const customersResult = await axios.post("./../../server/controllers/auth/endpoint.auth.php", {
    //       "getCustomers" : "all"
    //     });



    //   // If the fails, show the error message
    //   if (!customersResult.data.success)
    //     return (this.usersErrorMessage = customersResult.data.error.message);

    //   // else, update the customers list
    //   this.customers = customersResult.data.data;


      
    // },

    // end of LOGIN
  };
}
