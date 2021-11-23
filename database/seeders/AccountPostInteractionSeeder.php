<?php

namespace Database\Seeders;
use App\Models\AccountPostInteraction;
use App\Models\Notification;
use App\Models\Post;
use Illuminate\Database\Seeder;

class AccountPostInteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates 6 interactions
        $amount_of_interactions_to_produce = 6;
        //While it still needs to make more comments
        $production_count = 0;
        while($production_count < $amount_of_interactions_to_produce){
            //Make a comment and it's notification
            $produced_interaction = AccountPostInteraction::factory()->create();
            //adding the interaction to the post
            $post = Post::where('account_id', $produced_interaction->account_id)->first();

            if($produced_interaction->type=="like")
            {
                $post->likes = $post->likes + 1;
            }
            if($produced_interaction->type=="dislike")
            {
                $post->dislikes = $post->dislikes + 1;
            }
            $post->views = $post->views + 1;
            $post->save();
            
            Notification::factory()->createInteractionNotification($produced_interaction);
            //increase the amount produced count
            $production_count = $production_count + 1;
        }
    }
}
