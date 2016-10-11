<?php
    if(isset($_SESSION['admin'])){

        /*==========================
        ********** NEWS ***********
        ==========================*/
            include_once('model/home/count_news.php');
            $nbrNews = count_news();

            include_once('model/home/count_news_in_month.php');
            $nbrNewsInMonth = count_news_in_month();

        /*==========================
        ********** FAQS ***********
        ==========================*/
            include_once('model/home/count_faqs.php');
            $nbrFaqs = count_faqs();


            include_once('model/home/count_faq_categories.php');
            $nbrFaqCategories = count_faq_categories();

        /*=======================================================================
        ********** Filters ******** => filter_ranking with ajax in home/chart.php
        ========================================================================*/
            include_once('model/home/count_filters.php');
            $nbrFilters = count_filters();

            include_once('model/home/select_last_filters.php');
            $last_filters = select_last_filters(3);


        /*==========================
        ********** USERS *********** => user ranking with best upper and best iffer
        ==========================*/
            include_once('model/home/count_users.php');
            $nbrUsers = count_users();

            include_once('model/home/select_last_users.php');
            $last_users = select_last_users(3);

            include_once('model/home/count_users_in_month.php');
            $nbrUsersInMonth = count_users_in_month();

            include_once('model/home/count_users_not_confirmed.php');
            $nbrUsersNotConfirmed = count_users_not_confirmed();

            include_once('model/home/count_users_archived.php');
            $nbrUsersArchived = count_users_archived();



        /*==========================
        ******** SERVICES *********
        ==========================*/
            include_once('model/home/count_services_completed.php');
            $nbrServicesCompleted = count_services_completed();

            include_once('model/home/count_services_canceled.php');
            $nbrServicesCanceled = count_services_canceled();

            include_once('model/home/count_services_pending.php');
            $nbrServicesPending = count_services_pending();

            include_once('model/home/count_services_completed_in_month.php');
            $nbrServicesCompletedInMonth = count_services_completed_in_month();


        /*==========================
        ******* NEWSLETTERS ******* => lastsend; count nbr send ; count not send;
        ==========================*/
            include_once('model/home/count_newsletters.php');
            $nbrNewsletters = count_newsletters();

            include_once('model/home/count_newsletters_not_sent.php');
            $nbrNewslettersNotSent = count_newsletters_not_sent();

            include_once('model/home/count_newsletter_subscribers.php');
            $nbrNewsletterSubscribers = count_newsletter_subscribers();


        /*==========================
        *********** VIEW ***********
        ==========================*/
            include_once('view/home/index.php');
    }
    else{
        $_SESSION['flash']['danger'] = "Vous devez vous connecter pour accéder à cette partie du site.";
        header('Location: index.php?module=user-admin&action=login');
        exit();
    }