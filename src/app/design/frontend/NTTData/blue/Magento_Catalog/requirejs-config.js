var config = {
    paths: {
        slick: 'js/slick.min'
    },
    shim: {
        slick: {
            deps: ['jquery']
        }
      },
    map: {
        "*": {
        "stickyTest": "Magento_Catalog/js/pdpSticky"
        }
    }
   };
   