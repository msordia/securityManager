  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation({
    abide : {
      patterns: {
        dashes_only: /^[0-9-]*$/,
        ip_address: /^((25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])\.){3}(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[1-9][0-9]|[0-9])$/,
        mypassword : /^(.*)/
      }
    }
  });
  </script>