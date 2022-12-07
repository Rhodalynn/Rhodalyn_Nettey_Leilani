
  
  document.addEventListener('alpine:init', () => {
    Alpine.data('shopDataAlpineWrapper', () => ({
        init(){
            console.log("Shop controller started.")
        },
        products: [0,9,8,9],
    }))
})