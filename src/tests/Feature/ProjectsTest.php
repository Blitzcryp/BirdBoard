<?php

namespace Tests\Feature;

use Database\Factories\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    public function test_a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect("/projects");

        $this->assertDatabaseHas("projects", $attributes);

        $this->get("/projects")->assertSee($attributes['title']);
    }

    public function test_a_project_requires_a_title()
    {
        $attributes = (new ProjectFactory())->make();

        $this->post("/projects", $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_project_requires_a_description()
    {
        $attributes = (new ProjectFactory())->make();

        $this->post("/projects", $attributes)->assertSessionHasErrors('description');
    }
}
