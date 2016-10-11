<?php
    include_once('model/front/select_faq_categories.php');
    $faq_cats = select_faq_categories();

    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }


    if(isset($_GET['category'])){
        $category = $_GET['category'];

        include_once('model/front/count_faqs_per_cat.php');
        $allFaqs = count_faqs_per_cat($category);

        include_once('model/front/select_faqs_per_cat.php');
        $faqs = select_faqs_per_cat((($page-1)*FAQS_PER_PAGE), FAQS_PER_PAGE, $category);

        if($faqs){
            include_once('view/front/faq.php');
        }
        else{
            $_SESSION['flash']['danger'] = "Nous n'avons pas pu afficher la foire aux questions de cette catégorie. Veuillez réessayer.";
            header("Location: index.php?module=front&action=faq");
            exit();
        }
    }else{
        include_once('model/front/count_faqs.php');
        $allFaqs = count_faqs();

        include_once('model/front/select_faqs.php');
        $faqs = select_faqs((($page-1)*FAQS_PER_PAGE), FAQS_PER_PAGE);

        include_once('view/front/faq.php');
    }
