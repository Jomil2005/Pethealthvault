use App\Models\Role;

Role::firstOrCreate([
    'name' => 'Admin'
], [
    'description' => 'Administrator role',
]);

Role::firstOrCreate([
    'name' => 'Pet Owner'
], [
    'description' => 'Pet Owner role',
]);
