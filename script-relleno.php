<?php

include_once "app/config.inc.php";
include_once "app/Connection.inc.php";

include_once "app/classes/User.inc.php";
include_once "app/classes/Entry.inc.php";
include_once "app/classes/Comment.inc.php";

include_once "app/repositories/UserRepository.inc.php";
include_once "app/repositories/EntryRepository.inc.php";
include_once "app/repositories/CommentRepository.inc.php";

Connection::open_connection();

for ($users=0; $users < 100; $users++) {
    $data = [
        "username" => random_string(10),
        "email" => random_string(5)."@".random_string(6).".".random_string(3),
        "password" => password_hash("123456", PASSWORD_DEFAULT),
    ];    
    UserRepository::create_user(Connection::get_connection(), $data);
}

for ($entry=0; $entry < 100; $entry++) {
    $data = [
        "author_id" => rand(1, 100),
        "title" => random_string(20),
        "content" => lorem(),
        "active" => 1,
    ]; 
    EntryRepository::insert_entry(Connection::get_connection(), $data);
}

for ($comment=0; $comment < 100; $comment++) {
    $data = [
        "author_id" => rand(1, 100),
        "entry_id" => rand(1, 100),
        "title" => random_string(20),
        "content" => lorem(),
    ]; 
    CommentRepository::insert_comment(Connection::get_connection(), $data);
}

Connection::close_connection();

function random_string($length) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++){
        $randomString .= $characters[rand(0, $charactersLength -1)];
    }

    return $randomString;
}

function lorem(){
    $lorem = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a justo et odio eleifend molestie sit amet in libero. Nam cursus, tortor et auctor congue, justo velit imperdiet ligula, finibus imperdiet ipsum felis ut urna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Integer efficitur porta molestie. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus fringilla pharetra viverra. Duis eu pulvinar ligula. Nunc vitae mi tincidunt, blandit nulla in, interdum dolor. Integer quam tortor, accumsan ac lectus eget, cursus hendrerit lacus. Aenean turpis elit, auctor eget ipsum eu, lacinia placerat elit. Maecenas maximus ipsum nec mi feugiat, nec venenatis turpis accumsan. Nulla congue nulla sit amet libero dictum, vestibulum lacinia diam laoreet. Sed nec lacus ultricies augue accumsan dapibus. Sed id vestibulum augue.

Suspendisse vel pretium ipsum, at scelerisque nibh. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque in leo sed felis dignissim convallis. Phasellus gravida quam orci, sit amet ullamcorper purus tincidunt vel. Praesent vel bibendum elit. Ut vitae tellus leo. Nam pellentesque lorem eget viverra venenatis. Nullam a ex et sem faucibus pretium. Ut vel sem ante. Nullam vel dictum nisl, non aliquet nulla. Sed vitae laoreet ipsum. Praesent ultricies eu ex vitae aliquet. Proin et urna faucibus mi commodo congue quis eget eros.

Cras nec tellus lorem. Nunc in faucibus sapien, quis semper orci. Etiam interdum eros ac mi fermentum gravida. Nam condimentum interdum turpis, eu pulvinar lacus lacinia sed. Ut vitae imperdiet urna, at accumsan dolor. Sed mi ipsum, dapibus sit amet tellus eu, porta scelerisque ipsum. Cras vehicula velit arcu, sed sodales sem viverra sit amet. Vestibulum orci velit, vestibulum venenatis nisi quis, ultrices semper ipsum. Etiam metus diam, porta sed massa vitae, dictum placerat urna. Donec mattis augue non nisl placerat, dignissim dictum dui rutrum.

Sed sit amet interdum lectus. Quisque quis metus id diam lobortis rhoncus mattis eu mauris. Cras sed varius nulla, non mattis ligula. Nam aliquam orci felis, a viverra leo pretium luctus. Nam sed lacus laoreet nibh porttitor egestas ac ut lacus. Suspendisse enim eros, bibendum eget sollicitudin sed, laoreet et metus. Sed imperdiet euismod nisi id sollicitudin. Praesent dapibus, nibh eget posuere tempus, elit leo ultrices arcu, eget ornare metus purus a urna. Ut quis ante nec risus volutpat posuere sit amet id metus.

Sed hendrerit lorem vel leo lacinia aliquam. Cras vestibulum, lacus vel feugiat aliquet, leo sapien vehicula sapien, ac vestibulum lorem magna at elit. Maecenas sem mauris, elementum id molestie eget, fringilla sed magna. Nullam mollis ex sit amet justo finibus vestibulum. Integer tempus magna nec fermentum consequat. Fusce bibendum posuere enim, eu vehicula enim convallis at. Maecenas auctor mollis cursus. Duis ac quam ipsum. Aliquam leo lectus, consequat et mattis ac, interdum ut tortor. Vivamus blandit purus a lectus congue, a molestie sapien blandit. Curabitur a erat ligula. Mauris lobortis, justo ac lacinia eleifend, libero massa dignissim metus, eget tincidunt orci massa quis nisl. Phasellus vel tortor pharetra, lobortis turpis a, cursus augue. Suspendisse in leo sit amet ex mattis ultricies.";

    return $lorem;
}
