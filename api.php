public function blogDetails(){

        $response = array();
        $postData = json_decode(file_get_contents("php://input"));
        $blogId   =  $postData->blogId;
       
    $result = $this->api->getData('tbl_blog', "blog_id, CONCAT('https://www.onegodmed.com/admin-assets/assets/blog-images/', blog_image) as photoURL, heading, title, meta_tag, short_discription, DATE_FORMAT(date,'%M %e, %Y ')
         AS date, discription, author, view_count", array('blog_id'=>$blogId));

    $totalCount = ($result[0]->view_count)+1;
    $this->api->_updateRowWhere('tbl_blog', array('view_count'=> $totalCount), array('blog_id'=>$blogId));

    if ($result) {
        $response['status'] = true;
        $response['data'] = $result[0];
        $response['message'] = "Success: Fetched successfully.";
        $httpCode = 200;
    } else {
      $response['status'] = false;
      $response['message'] = "No Data Found";
      $httpCode = 203;
    }

     echo json_encode($response);
     die();

    }
