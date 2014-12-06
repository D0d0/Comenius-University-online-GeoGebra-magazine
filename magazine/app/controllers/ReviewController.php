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
            $users = UserRole::where('rank_id', '=', User::REDACTION);
            foreach ($users as $user) {
                $email = $user->user->email;
                $name =  $user->user->name;
                Mail::send('emails.reviewed', array('id' => $input['id']), function($message)use($email, $name) {
                    $message->to($email, $name)
                            ->subject('Článok bol orecenzovaný');
                });
            }
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
            $email = User::find($input['reviewer_id'])->email;
            $name = User::find($input['reviewer_id'])->name;
            Mail::send('emails.new_review', array('id' => $input['id']), function($message)use($email, $name) {
                $message->to($email, $name)
                        ->subject('Nový článok na orecenzovanie');
            });
            return Response::json(array('result' => true));
        }
    }

}
