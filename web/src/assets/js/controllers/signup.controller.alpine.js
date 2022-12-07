function signupDataAlpineWrapper() {
  return {
    isPasswordValid: null,
    isEmailValid: null,
    signupErrorMessage: "",
    customerData: {
      email: "",
      password: document.getElementById("passwordField").value,
      fname: "",
      lname: "",
      contact: ""
    },
    storeCustomerData() {
      localStorage.setItem("customerData", this.customerData);
    },
    clearErrors() {
      this.isPasswordValid = null;
      this.isEmailValid = null;
      this.signupErrorMessage = "";
    },
    async signup() {
      // Clear all errors
      this.clearErrors();

      
      // Send a request to the server to signup customer.
      const signupResult = await axios.post("./../../server/controllers/auth/endpoint.auth.php", {
          "signup" : this.customerData
        });

      // If the login fails, show the error message
      if (!signupResult.data.success)
        return (this.signupErrorMessage = signupResult.data.error.message);

      //Redirect to signin page.
      location.href = "login.html";
    },
  };
}
