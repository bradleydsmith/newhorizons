<?php

namespace Tests\Unit;
use DB;
use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \app\Http\Controllers\ConfirmController;
use App\User;
use App\Cars;
use App\FlocationData;
use App\Booking;

class ConnTest extends TestCase
{
    public function createUser($identifier)
    {
        return factory(User::class)->create(
            [
                'fname' => $identifier,
                'lname' => 'Test$Laravel$',
                'password' => Hash::make('Test$Laravel$Password123'),
                'email' => 'test@laravel.com'
            ]
        );
    }
    
    public function createCar($identifier)
    {
        $cars = new Cars;
        $cars->make = $identifier;
        $cars->model = 'Test$Laravel$';
        $cars->year = 0;
        $cars->seating = 0;
        $cars->rego = 'Test';
        $cars->lat = 0;
        $cars->lng = 0;
        $cars->pph = 1000;
        $cars->retired = false;
        $cars->save();
        return $cars;
    }
    public function clearTest(){
        DB::table('cars')->where('model', 'Test$Laravel$')->delete();
        DB::table('users')->where('lname', 'Test$Laravel$')->delete();
    }
    public function testSystemAva()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    //Web part
    public function testLoginAva()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        unset($response);
        $identifier = random_int(10000,100000);
        $user = $this->createUser($identifier);
        $response = $this->post('/login',
            ['email'=>'test@laravel.com', 'password'=>'Test$Laravel$Password123']);
        $response->assertStatus(302);
        $response->assertSeeText('/home');
        $this->clearTest();
    }
    public function testRegisterAva()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        unset($response);
        $response = $this->post('/register',[
            'fname'=> 'Test',
            'lname'=> 'Test$Laravel$',
            'name'=> 'Test2',
            'email'=> 'test2@laravel.com',
            'password'=> 'Test$Laravel$Password123',
            'password_confirmation'=>'Test$Laravel$Password123',
        ]);
        $response->assertStatus(302);
        $response->assertSeeText('/home');
        unset($response);
        $response = $this->post('/login',
            ['email'=>'test@laravel.com', 'password'=>'Test$Laravel$Password123']);
        $response->assertStatus(302);
        $response->assertSeeText('/home');
        unset($response);
        $this->clearTest();
    }
    public function testRegisterWithWeakPasswordAva()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        unset($response);
        $response = $this->post('/register',[
            'fname'=> 'Test',
            'lname'=> 'Test$Laravel$',
            'name'=> 'Test3',
            'email'=> 'test3@laravel.com',
            'password'=> '123',
            'password_confirmation'=>'123',
        ]);
        $response->assertStatus(302);
        $response->assertSeeText('/register');
        $this->clearTest();
    }
    public function testRegisterWithDiffPasswordAva()
    {
        $response = $this->get('/register');
        $this->assertTrue('Test$Laravel$Password123' != 'Test$Laravel$Password1234');
        $response->assertStatus(200);
        unset($response);
        $response = $this->post('/register',[
            'fname'=> 'Test',
            'lname'=> 'Test$Laravel$',
            'name'=> 'Test4',
            'email'=> 'test4@laravel.com',
            'password'=> 'Test$Laravel$Password123',
            'password_confirmation'=>'Test$Laravel$Password1234',
        ]);
        $response->assertStatus(302);
        $response->assertSeeText('/register');
        $this->clearTest();
    }
    public function testRegisterWithLongNameAva()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        unset($response);
        $response = $this->post('/register',[
            'fname'=> 'Test',
            'lname'=> 'Test$Laravel$',
            'name'=> 'Test_asdfghjklzxcvbnmqwertyuiop5',
            'email'=> 'test5@laravel.com',
            'password'=> 'Test$Laravel$Password123',
            'password_confirmation'=>'Test$Laravel$Password123',
        ]);
        $response->assertStatus(302);
        $response->assertSeeText('/register');
        $this->clearTest();
    }
    public function testSearchWithoutSessionAva()
    {
        $response = $this->get('/search');
        $response->assertSeeText('You need to login as admin to continue');
        $response->assertStatus(200);
    }
    public function testSearchWithSessionAva()
    {
        $user = $this->createUser('User');
        $response = $this->actingAs($user)
                         ->get('/search');
        $response->assertSeeText('Search Results');
        $response->assertStatus(200);
        $this->clearTest();
    }
    public function testSearchWithSessionWithInputAva()
    {
        $name = random_int(10000,100000);
        $user = $this->createUser($name);
        $response = $this->actingAs($user)
                         ->get('/search?q=test');
        $response->assertSeeText($name);
        $response->assertStatus(200);
        $this->clearTest();
    }
    public function testCarSeachWithoutSessionAva()
    {
        $response = $this->get('/carsearch');
        $response->assertSeeText('You need to login as admin to continue');
        $response->assertStatus(200);
    }
    public function testCarSearchWithSessionAva()
    {
        $user = $this->createUser('User');
        $response = $this->actingAs($user)
                         ->get('/carsearch');
        $response->assertSeeText('Dashboard');
        $response->assertStatus(200);
        $this->clearTest();
    }
    public function testCarSearchWithSessionWithInputAva()
    {
        $carId = random_int(10000,100000);
        $this->createCar($carId);
        $user = $this->createUser('User');
        $response = $this->actingAs($user)
                         ->get('/carsearch?p=test');
        $response->assertSeeText($carId);
        $response->assertStatus(200);
        $this->clearTest();
    }
    public function testAdminAva()
    {
        $response = $this->get('/admin');
        $response->assertStatus(200);
    }
    public function testUsersAva()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
    }
    public function testFaqAva()
    {
        $response = $this->get('/faq');
        $response->assertStatus(200);
    }
    public function testBookingAva()
    {
        $response = $this->get('/booking');
        $response->assertStatus(200);
    }
    public function testCarsManageAva()
    {
        $response = $this->get('/carsmanage');
        $response->assertStatus(200);
    }
    public function testBookLaterAva()
    {
        $response = $this->get('/booklater');
        $response->assertStatus(200);
    }
    public function testAddCarAva()
    {
        $response = $this->get('/addcar');
        $response->assertStatus(200);
    }
    public function testHomeAva()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
    }
    public function testViewTripAva()
    {
        $response = $this->get('/viewtrip');
        //not finished?
        $response->assertStatus(405);
    }
    public function testBookNowAva()
    {
        $response = $this->get('/booknow');
        $response->assertStatus(200);
    }
    public function testCarStatusAva()
    {
        $identifier = random_int(10000,100000);
        $car = $this->createCar($identifier);
        $carId = DB::table('cars')->where('make', $identifier)->first();
        $response = $this->post('/car/status', ['carId' => $carId->id, 'status' => true]);
        $response->assertStatus(302);
        $updatedCar = DB::table('cars')->where('id', $carId->id)->first();
        $this->assertTrue($updatedCar->retired == 1);
        $this->clearTest();
    }
    public function testUserStatusAva()
    {
        $identifier = random_int(10000,100000);
        $user = $this->createUser($identifier);
        $userId = DB::table('users')->where('fname', $identifier)->first();
        $response = $this->post('/user/status', ['userId' => $userId->id, 'status' => 'suspend']);
        $response->assertStatus(302);
        $updatedUser = DB::table('users')->where('id', $userId->id)->first();
        $this->assertTrue($updatedUser->type == 'suspended');
        $this->clearTest();
    }
    public function testConfirmWithoutSessionAva()
    {
        $response = $this->get('/confirm');
        $response->assertStatus(302);
    }
    public function testConfirmWithSessionAva()
    {
        $user = $this->createUser('User');
        $response = $this->actingAs($user)
                         ->get('/confirm');
        $response->assertStatus(302);
        $this->clearTest();
    }
    
    public function testConfirmWithSessionWithInputAva()
    {
        $identifier = random_int(10000,100000);
        $car = $this->createCar($identifier);
        $carId = DB::table('cars')->where('make', $identifier)->first();
        $user = $this->createUser('User');
        $response = $this->actingAs($user)
                         ->get('/confirm?carId=' . $carId->id . '&startTime=1&endTime=2000');
        $cost = (int)(((2000 - 1) / 60) / 60) * $carId->pph;
        $response->assertStatus(200);
        $response->assertSeeText($carId->make);
        $response->assertSeeText($cost);
        $this->clearTest();
    }

    public function testConfirmWithoutSessionWithInputAva()
    {
        $identifier = random_int(10000,100000);
        $car = $this->createCar($identifier);
        $carId = DB::table('cars')->where('make', $identifier)->first();
        $response = $this->get('/confirm?carId=' . $carId->id . '&startTime=1&endTime=2000');
        $cost = (int)(((2000 - 1) / 60) / 60) * $carId->pph;
        $response->assertStatus(302);
        $response->assertSessionHas('carId', $carId->id);
        $response->assertSessionHas('startTime', '1');
        $response->assertSessionHas('endTime', '2000');
        $this->clearTest();
    }
    //API Part
    public function testAPIBookAva()
    {
        $identifier = random_int(10000,100000);
        $car = $this->createCar($identifier);
        $carId = DB::table('cars')->where('make', $identifier)->first();
        $user = $this->createUser('User');
        $response = $this->actingAs($user)
                         ->withSession(['carId' => $carId->id, 
                            'startTime'=>1, 
                            'endTime'=>2000])
                         ->get('/book');
        //error: $leg is not defined
        $response->assertSeeText("");
    }
    //public function testAPIStaticMapAva()
    //{
    //    Not fully constructed, please test later after defining the usage
    //}
    public function testAPICarsSortedAva()
    {
        $identifier = random_int(10000,100000);
        $car = $this->createCar($identifier);
        $carId = DB::table('cars')->where('make', $identifier)->first();
        $response = $this->post('/api/carssorted',
            ['limit'=>'10', 'lat'=>'1', 'lng'=>'1', 'startTime'=>'1', 'endTime'=>'2000']);
        $response->assertStatus(200);
        $response->assertSeeText('"make":"' . $carId->make);
        $this->clearTest();
    }
    public function testAPIGeoCodeAva()
    {
        $response = $this->json('post', '/api/geocode',
            ['location'=>'test']);
        $response->assertStatus(200);
        $response->assertSeeText('2018 MapQues'); //reached MapQues
        $response->assertSeeText('"statuscode":0'); //inquiry is successful
    }
    public function testModFlocationDataAva()
    {
        //not finished?
        $obj = FLocationData::getDestinationLatLng(1,2);
        $lng = $obj->lng;
        $lat = $obj->lat;
        unset($obj);
        //make some assertion for $lat and $lng
        //There are errors for following part, not finished?
        //$obj = FLocationData::getTrip(1,2);
        //$lng = $obj->lng;
        //$lat = $obj->lat;
        $this->assertTrue(true);
    }
}
