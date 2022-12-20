console.log("Got in here")
  
document.addEventListener('alpine:init', () => {
    console.log("Init alpine!")
    Alpine.data('dropdown', () => ({
        open: false,

        toggle() {
            this.open = ! this.open
        }
    }))
})