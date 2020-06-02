<?php

namespace Tests\Feature;

use App\Models\Todotask;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class TodotaskTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Test root redirect to client app code
     */
    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertRedirect('/app');
    }

    /**
     * Tests create task and getting it form the endpoint, verifies one task is returned and its format
     * @test
     */
    public function create_and_get_todotask()
    {
        $todotask = factory(Todotask::class)->create();
        $response = $this->getJson('/api/todotasks');

        $response
            ->assertStatus(200)
            ->assertJsonCount(1)
            ->assertSee($todotask->task)
            ->assertSee($todotask->task_description)
            ->assertJsonStructure([['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at']])
            ;
    }

    /**
     * Tests create 10 tasks and getting all of them form the endpoint, verifies all 10 tasks are returned and its format
     * @test
     */
    public function create_and_get_multiple_todotasks()
    {
        $todotask = factory(Todotask::class, 10)->create();
        $response = $this->getJson('/api/todotasks');

        $response
            ->assertStatus(200)
            ->assertJsonCount(10)
            ->assertJsonStructure([['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at']])
            ;
    }


    /**
     * Tests create task and getting it form the endpoint, verifies one task is returned and its format
     * @test
     */
    public function create_and_get_todotask_by_id()
    {
        $todotask = factory(Todotask::class)->create();
        $response = $this->getJson('/api/todotask/' . $todotask->id);

        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'id' => $todotask->id,
                    'task' => $todotask->task,
                    'task_description' => $todotask->task_description
                ])
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at'])
        ;
    }


    /**
     * Tests create a task using the endpoint and verify it's on the DB
     * @test
     */
    public function create_on_endpoint_and_verify_db()
    {
        $newTask = [
            'task' => 'this is the new task ' . time(),
            'task_description' => 'this is the new task description ' . time(),
        ];

        $response = $this->postJson('/api/todotask/post', $newTask);

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'id' => 1,
                    'task' => $newTask['task'],
                    'task_description' => $newTask['task_description'],
                ])
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at'])
        ;

        $this->assertDatabaseHas('todotasks', $newTask);
    }

    /**
     * Tests create a task using the endpoint, then deleting it and verify it's on the DB
     * @test
     */
    public function create_on_endpoint_updates_and_verify_db()
    {
        $newTask = [
            'task' => 'this is the new task ' . time(),
            'task_description' => 'this is the new task description ' . time(),
        ];

        $response = $this->postJson('/api/todotask/post', $newTask);

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'id' => 1,
                    'task' => $newTask['task'],
                    'task_description' => $newTask['task_description'],
                ])
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at'])
        ;
        $this->assertDatabaseHas('todotasks', $newTask);


        $updatedTask = [
            'task' => 'this is the updated task ' . time(),
            'task_description' => 'this is the updated task description ' . time(),
        ];
        $response = $this->putJson('/api/todotask/put/1', $updatedTask);


        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'id' => 1,
                    'task' => $updatedTask['task'],
                    'task_description' => $updatedTask['task_description'],
                ])
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at'])
        ;
        $this->assertDatabaseMissing('todotasks', $newTask);
        $this->assertDatabaseHas('todotasks', $updatedTask);
    }



    /**
     * Tests create a task using the endpoint, then deletes it and verify it not on the DB
     * @test
     */
    public function create_on_endpoint_delete_and_verify_db()
    {
        $newTask = [
            'task' => 'this is the new task '.time(),
            'task_description' => 'this is the new task description '.time(),
        ];

        $response = $this->postJson('/api/todotask/post', $newTask);

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'id' => 1,
                    'task' => $newTask['task'],
                    'task_description' => $newTask['task_description'],
                ]
            )
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at']);

        $this->assertDatabaseHas('todotasks', $newTask);


        $response = $this->deleteJson('/api/todotask/delete/1');
        $response
            ->assertStatus(200)
            ->assertJson(
                [
                    'success' => true,
                ]
            );

        $this->assertDatabaseMissing('todotasks', $newTask);
    }


    /**
     * Tests create a task using the endpoint, then deletes it and verify it not on the DB
     * @test
     */
    public function retrieve_non_existing_task()
    {
        $response = $this->get('/api/todotask/99999');
        $response->assertStatus(404);
    }

    /**
     * Tests create a task using the endpoint, then deletes it and verify it not on the DB
     * @test
     */
    public function delete_non_existing_task()
    {
        $response = $this->delete('/api/todotask/delete/99999');
        $response->assertStatus(404);
    }


    /**
     * Tests create a task using the endpoint, then deleting it and verify it's on the DB
     * @test
     */
    public function put_non_existing_task()
    {
        $updatedTask = [
            'task' => 'this is the updated task ' . time(),
            'task_description' => 'this is the updated task description ' . time(),
        ];

        $response = $this->putJson('/api/todotask/put/9999', $updatedTask);
        $response->assertStatus(404);
    }


    /**
     * Tests create a task without filling the required fields
     * @test
     */
    public function verify_validation_on_create()
    {
        $newTask = [
            'task' => '',
            'task_description' => '',
            'finished' => 'a',
        ];

        $response = $this->postJson('/api/todotask/post', $newTask);

        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['task', 'task_description', 'finished']])
        ;
    }



    /**
     * Tests create a task using the endpoint, then tries to update it using invalid data
     * @test
     */
    public function create_on_endpoint_verify_validation_on_put()
    {
        $newTask = [
            'task' => 'this is the new task '.time(),
            'task_description' => 'this is the new task description '.time(),
        ];

        $response = $this->postJson('/api/todotask/post', $newTask);

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'id' => 1,
                    'task' => $newTask['task'],
                    'task_description' => $newTask['task_description'],
                ]
            )
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at']);

        $this->assertDatabaseHas('todotasks', $newTask);



        $updatedTask = [
            'task' => '',
            'task_description' => '',
            'finished' => 'a',
        ];
        $response = $this->putJson('/api/todotask/put/1', $updatedTask);

        $response
            ->assertStatus(422)
            ->assertJsonStructure(['message', 'errors' => ['task', 'task_description', 'finished']])
        ;
    }


    /**
     * Tests create a task using the endpoint, then tries to update its status
     * @test
     */
    public function create_on_endpoint_flag_as_finished()
    {
        $newTask = [
            'task' => 'this is the new task '.time(),
            'task_description' => 'this is the new task description '.time(),
        ];

        $response = $this->postJson('/api/todotask/post', $newTask);

        $response
            ->assertStatus(201)
            ->assertJson(
                [
                    'id' => 1,
                    'task' => $newTask['task'],
                    'task_description' => $newTask['task_description'],
                ]
            )
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at']);

        $this->assertDatabaseHas('todotasks', $newTask);



        $updatedTask = [
            'finished' => '1',
        ];
        $response = $this->putJson('/api/todotask/put/1', $updatedTask);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['id', 'task', 'task_description', 'finished', 'finished_at', 'created_at', 'updated_at']);
        ;

        // add the new finished status
        $newTask['finished'] = 1;
        $this->assertDatabaseHas('todotasks', $newTask);
    }
}
