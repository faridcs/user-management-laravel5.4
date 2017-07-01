<?php
    namespace Tests;

    use App\Models\User;
    use App\Permission;
    use App\Role;
    use Illuminate\Foundation\Testing\DatabaseTransactions;
    use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseTransactions;
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */

    protected $baseUrl = '';

    protected $user = null;

    //@codingStandardsIgnoreStart
    public function setUp()
    {
        parent::setUp();
    }


    public function user()
    {
        return User::find(1);
    }

    public function role()
    {
        return factory(Role::class)->create();
    }

    public function permission()
    {
        return factory(Permission::class)->create();
    }

}
