<?php

class ReviewController extends BaseController {

    function postAddReview() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$article = Article::find($input['id'])) {
                return Response::json(array('result' => true));
            }
            $review = $article->review;
            $review->text = str_replace('\'', '', trim($input['text']));
            $review->save();
            $article->state = $input['state'];
            $article->save();
            // POSLI VSETKYM Z REDAKCNEJ RADY
            return Response::json(array('result' => true));
        }
    }

    function postCreateReview() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$article = Article::find($input['id'])) {
                return Response::json(array('result' => true));
            }
            $review = new Review;
            $review->id_article = $input['id'];
            $review->reviewer_id = $input['reviewer_id'];
            $review->save();
            // POSLI MAILIS RECENZENT TREBA NOVY VIEW
            return Response::json(array('result' => true));
        }
    }

}
