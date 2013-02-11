<?

    function oldBrowser() {
        $old = 0;

        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            // IE <= 7
            // User Agent: Opera/9.80 (Windows NT 6.1; U; en) Presto/2.10.229 Version/11.61
            if (preg_match('#msie\s+(\d+)\.(\d+)#si', $_SERVER['HTTP_USER_AGENT'], $matches)) {
                if ($matches[1] <= 8) {
                    $old = 1;
                }
            }
            // Firefox <= 7
            // User Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:10.0.2) Gecko/20100101 Firefox/10.0.2
            elseif (preg_match('#Firefox/(\d+)\.(\d+)[\.\d]+#si', $_SERVER['HTTP_USER_AGENT'], $matches)) {
                if ($matches[1] <= 10) {
                    $old = 1;
                }
            }
            // Safari < 5
            // User Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.52.7 (KHTML, like Gecko) Version/5.1.2 Safari/534.52.7
            elseif (preg_match('#Version/(\d+)[\.\d]+ Safari/[\.\d]+#si', $_SERVER['HTTP_USER_AGENT'], $matches)) {
                if ($matches[1] < 5) {
                    $old = 1;
                }
            }
            // opera < 11
            // User Agent: Opera/9.80 (Windows NT 6.1; U; en) Presto/2.10.229 Version/11.61
            elseif (preg_match('#Opera/[\.\d]+.*?Version/(\d+)[\.\d]+#si', $_SERVER['HTTP_USER_AGENT'], $matches)) {
                if ($matches[1] < 11) {
                    $old = 1;
                }
            }
        }

        return $old;
    }

?>