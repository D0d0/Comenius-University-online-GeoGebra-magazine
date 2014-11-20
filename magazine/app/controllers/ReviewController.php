<?php

class ReviewController extends BaseController {

    function postAddReview() {
        if (Request::ajax()) {
            $input = Input::all();
            if (!$article = Article::find($input['id'])) {
                return Response::json(array('result' => true));
            }
            Review::where('id_article', '=', $article->id)->delete();
            $review = new Review;
            $review->article = $article->id;
            $review->reviewer_id = Auth::id();
            $review->text = str_replace('\'', '', trim($input['text']));
            $review->save();
            $article->state = $input['state'];
            $article->save();
            return Response::json(array('result' => true));
        }
    }

}
