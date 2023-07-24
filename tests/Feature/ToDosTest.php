<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;

class ToDosTest extends TestCase
{
    use RefreshDatabase;

    public function test_todos_creation(): void
    {
        $token = $this->getToken();
        $todo_creation_response = $this->createToDo('Test to do', $token);
        
        $todo_creation_response->assertStatus(200);

        $todo_creation_response->assertJsonIsObject();

        $todo_creation_response->assertJson(fn (AssertableJson $json) => 
        $json
            ->has('message')
            ->has('todo', fn(AssertableJson $todo) => 
            $todo
            ->hasAll(['id', 'body', 'user_id', 'created_at', 'updated_at'])
            )
        );
    }

    
    public function test_todos_listing()
    {
        $token = $this->getToken();
        
        foreach(range(0,5) as $i){
            $this->createToDo('Todo test body', $token);
        }
        
        $todos_list_response = $this->getTodos($token);
        
        $todos_list_response->assertStatus(200);
        
        $todos_list_response->assertJsonIsArray();
        
        $todos_list_response->assertJson(fn (AssertableJson $json) => 
        $json->first(fn (AssertableJson $json) =>
        $json->has('body')
                    ->has('is_prioritary')
                    ->has('is_completed')
                    ->etc()
                    )
                );
            }
            
            public function test_todo_update()
            {
        $token = $this->getToken();
        
        $todo_creation_response = $this->createToDo($token);
        
        $todo_id = $todo_creation_response->baseResponse->original['todo']['id'];
        
        $body = [
            'is_completed' => true,
            'is_prioritary' => true,
        ];
        
        $todo_update_response = $this->updateTodo($token, $todo_id, $body);
        
        $todos_listing_response = $this->getTodos($token);
        
        echo json_encode($todos_listing_response->baseResponse->original);
        
        $todos_listing_response->assertJson(fn (AssertableJson $json) =>
        $json->first(fn (AssertableJson $json) => 
        $json
        ->where('is_completed', 1)
        ->where('is_prioritary', 1)
        ->etc()
        )
    );}

    public function test_todo_creation_with_wrong_token()
    {
        $token = 'wrong-token';

        $todo_creation_response = $this->createToDo($token);

        $todo_creation_response->assertStatus(401);
    }

    public function test_todo_delete()
    {
        $token = $this->getToken();

        $todo_creation_response = $this->createToDo($token);
        $todo_id = $todo_creation_response->baseResponse->original['todo']['id'];

        $todo_delete_response = $this->deleteTodo($todo_id, $token);

        $todo_delete_response->assertStatus(200);

        $todos_listing_response = $this->getTodos($token);

        $todos_listing_response->assertJsonCount(0);
    }

    private function getToken() {
        $email = 'test@test.com';
        $password = 'password123';
        
        $this->user = User::create([
            'name' => 'Test user',
            'password' => $password,
            'email' => $email,
        ]);
        
        $response = $this
        ->withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
            ])
                    ->postJson(
                        '/api/login',
                        [
                            'email' => $email,
                            'password' => $password,
                            ]
                        );
                        
        $token = $response->baseResponse->original['authorization']['token'];
        return $token;
    }
                
    private function createToDo($token) {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
                ])
            ->postJson(
                '/api/todos',
                [
                    'body' => 'Testing To Do',
                ]
                );
        return $response;
    }

    private function getTodos($token)
    {
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
                ])
            ->getJson('/api/todos');
        return $response;
    }

    private function updateTodo($token, $todo_id, $body)
    {
        $path = '/api/todos/'.$todo_id;
        echo $path;
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
                ])
            ->putJson(
                $path,
                $body
                );
        return $response;
    }

    private function deleteTodo($todo_id, $token)
    {
        $path = '/api/todos/'.$todo_id;
        echo $path;
        $response = $this
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$token,
                ])
            ->deleteJson(
                $path
                );
        return $response;
    }
}
            