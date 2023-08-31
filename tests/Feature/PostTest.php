<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BlogPost;
use App\Comment;
use Carbon\Factory;

class PostTest extends TestCase
{
    use RefreshDatabase;
    public function testNoBlogPostsWhenNothingInDatabase(): void
    {
        $response = $this->get('/post');
        $response->assertSeeText('No Data in the Database!');
    }

    public function testSee1BlogPostWhenWithNoComments()
    {
        //Arrange Part
        $post = $this->createDummyBlogPost();

        // $post = $this->createDummyBlogPost();

        //Act part
        $response =  $this->get('/posts');

        //Assert part
        $response->assertSeeText('New Title');
        $response->assertSeeText('No New Comments yet!');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'New Title'
        ]);
    }

    public function testSee1BlogPostWhenWithComments()
    {
        //Arrange Part
        $post = $this->createDummyBlogPost();
        \App\Models\User::factory(4)->create([
            'blog_post_id' => $post->id
        ]);

        // factory(Comment::class, 4)->create([
        //     'blog_post_id' => $post->id
        // ]);


        //Act part
        $response = $this->get('/post');

        $response->assertSeeText('4 comments');
    }




    public function testStoreValid()
    {
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];
        $this->post('/post', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post was created Successfully!');
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];
        $this->post('/post', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $messages = session('errors')->getMessages();
        // dd($messages->getMessages());
        $this->assertEquals($messages['title'][0], 'The title field must be at least 5 characters.');
        $this->assertEquals($messages['content'][0], 'The content field must be at least 10 characters.');
    }

    public function testUpdateValid()
    {
        $post = $this->createDummyBlogPost();

        $this->assertDatabaseHas('blog_posts', $post->getAttributes());

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];
        $this->put("/post/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(
            session('status'),
            'Blog Post was Updated Successfully!'
        );
        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());
        // $this->assertDatabaseMissing('blog_posts', [
        // 'title' => 'A new named title'
        // ]);
    }


    public function testDelete()
    {
        $post = $this->createDummyBlogPost();

        $this->delete("/post/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertDatabaseMissing('blog_posts', $post->getAttributes());

        $this->assertEquals(session('status'), 'Blog Post was Deleted Successfully!');
    }

    private function createDummyBlogPost()
    {
        $post = new BlogPost();
        $post->title = 'New Title';
        $post->content = 'Content of the blog post';
        $post->save();

        return $post;
    }
}
