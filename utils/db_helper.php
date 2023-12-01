<?php


class DBHelper
{

  public $host = "localhost";
  public $user = "u1635882_third_f";
  public $password = "oV9gV1nR9luU9jA7";
  public $db = "u1635882_third_face";

  public $mysqli;

  function __construct()
  {

    $this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->db);
    $this->mysqli->set_charset("utf8");

    // Check connection
    if ($this->mysqli->connect_errno) {
      echo "Failed to connect to MySQL: " . $this->mysqli->connect_error;
      exit();
    }
  }

  function getDirectionById($id)
  {
    $sql = "SELECT * FROM directions WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      try {
        return $result->fetch_assoc()["title"];
      } catch (\Throwable $th) {
        return "undefined";
      }
    } else {
      return "undefined";
    }
  }

  function getSubjectById($id)
  {
    $sql = "SELECT * FROM subjects WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      try {
        return $result->fetch_assoc()["title"];
      } catch (\Throwable $th) {
        return "undefined";
      }
    } else {
      return "undefined";
    }
  }

  function getTopicById($id)
  {
    $sql = "SELECT * FROM topics WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      try {
        return $result->fetch_assoc()["title"];
      } catch (\Throwable $th) {
        return "undefined";
      }
    } else {
      return "undefined";
    }
  }

  function getDirections()
  {
    $res = [];
    $sql = "SELECT * FROM directions";
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }
    return $res;
  }

  function addDirection($title, $name, $password)
  {
    $sql = "INSERT INTO `directions` (`title`, `username`, `password`) 
    VALUES ('$title', '$name', '$password')";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function addTopic($title, $desc, $image, $dir, $sub)
  {
    $sql = "INSERT INTO `topics` (`id`, `title`, `description`, `wallpaper`, `subject_id`, `direction_id`)
    VALUES (NULL, '$title', '$desc', '$image', '$dir', '$sub');";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function addSubject($title, $wallpaper, $direction)
  {
    $sql = "INSERT INTO `subjects` (`title`, `wallpaper`, `direction_id`) 
    VALUES ('$title', '$wallpaper', '$direction')";
    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function removeDirection($id)
  {
    $sql = "DELETE FROM directions WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      return true;
    } else {
      return "undefined";
    }
  }

  function getSubjects()
  {
    $res = [];
    $sql = "SELECT * FROM subjects";
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $row["direction"] = $this->getDirectionById($row["direction_id"]);
        $res[] = $row;
      }
      $result->free_result();
    }
    return $res;
  }

  function getTpics()
  {
    $res = [];
    $sql = "SELECT * FROM topics";
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $row["direction"] = $this->getDirectionById($row["subject_id"]);
        $row["subject"] = $this->getSubjectById($row["direction_id"]);
        $res[] = $row;
      }
      $result->free_result();
    }
    return $res;
  }

  function getTpicsBysubject($id)
  {
    $res = [];
    $sql = "SELECT * FROM topics WHERE direction_id=$id";
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $row["direction"] = $this->getDirectionById($row["subject_id"]);
        $row["subject"] = $this->getSubjectById($row["direction_id"]);
        $res[] = $row;
      }
      $result->free_result();
    }
    return $res;
  }

  function getSubjectsByDirection($id)
  {
    $res = [];
    $sql = "SELECT * FROM subjects WHERE direction_id = $id";
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $row["direction"] = $this->getDirectionById($row["direction_id"]);
        $res[] = $row;
      }
      $result->free_result();
    }
    return $res;
  }

  function getField($field)
  {
    $sql = "SELECT * FROM fields WHERE field='$field'";
    if ($result = $this->mysqli->query($sql)) {
      return $result->fetch_assoc()["value"];
    } else {
      return "undefined";
    }
  }

  function deleteUser($token)
  {
    $sql = "DELETE FROM users WHERE token='$token'";
    if ($result = $this->mysqli->query($sql)) {
      return true;
    } else {
      return "undefined";
    }
  }

  function removePosition($id)
  {
    $sql = "DELETE FROM products WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      return true;
    } else {
      return "undefined";
    }
  }

  function removeRegion($id)
  {
    $sql = "DELETE FROM delivery WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      return true;
    } else {
      return "undefined";
    }
  }

  function getUserById($id)
  {
    $sql = "SELECT * FROM users WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      return $result->fetch_assoc();
    } else {
      return array("id" => -1, "fullName" => "Удаленный пользователь", "phone" => "Удаленный пользователь");
    }
  }

  function getStat($days = 7)
  {
    $res = [];
    $sql = "SELECT * FROM visitors_log WHERE `date` between date_sub(now(),INTERVAL $days DAY) and now()";
    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function viewProduct($id)
  {
    $sql = "UPDATE products SET views = views + 1 WHERE id = $id";
    if ($result = $this->mysqli->query($sql)) {
      return true;
    } else {
      return false;
    }
  }

  function orderProduct($id)
  {
    $sql = "UPDATE products SET orders = orders + 1 WHERE id = $id";
    if ($result = $this->mysqli->query($sql)) {
      return true;
    } else {
      return false;
    }
  }

  function getDestinationById($id)
  {
    $sql = "SELECT * FROM destinations WHERE id=$id";
    if ($result = $this->mysqli->query($sql)) {
      return $result->fetch_assoc();
    } else {
      return "undefined";
    }
  }

  function generateToken($length)
  {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
  }


  function setField($key, $value)
  {
    $sql = "UPDATE `fields` SET `value` = '$value' WHERE field = '$key';";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function setOrderStatus($id, $value)
  {
    $sql = "UPDATE `orders` SET `state` = '$value' WHERE id = '$id';";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function editRegion($id, $region, $price)
  {
    $sql = "UPDATE `delivery` SET `region` = '$region', `price` = '$price' WHERE id = '$id';";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function newPosition($title, $description, $specs, $price, $discount, $images, $cover, $category, $ar_obj, $threed_obj, $availability, $materials, $views, $orders, $date)
  {
    $sql = "INSERT INTO `products` (`title`, `description`, `specs`, 
    `price`, `discount`, `images`, `cover`, `category`, `ar_obj`, `3d_obj`, `availability`, `materials`, `views`, `orders`, `date`) 
VALUES ('$title', '$description', '$specs', 
'$price', '$discount', '$images', '$cover', '$category', '$ar_obj', '$3d_obj', '$availability', '$materials', '$views', '$orders', '$date')";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      // echo $this->mysqli->error;
      // exit();
      return false;
    }
  }

  function newCategory($title, $icon)
  {
    $sql = "INSERT INTO `categories` (`title`, `icon`) 
    VALUES ('$title', '$icon')";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function newRegion($region, $price)
  {
    $sql = "INSERT INTO `delivery` (`region`, `price`) 
    VALUES ('$region', '$price')";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function newOrder($customer, $phone, $product, $region)
  {
    $sql = "INSERT INTO `orders` (`customer`, `number`, `product`, `region`, `state`, `date`) 
    VALUES ('$customer', '$phone', '$product', '$region', 'Новый', NOW())";

    if ($this->mysqli->query($sql) === TRUE) {
      $this->orderProduct($product);
      return true;
    } else {
      return false;
    }
  }

  function newVisitor($ip, $device, $page)
  {
    $sql = "INSERT INTO `visitors_log` (`date`, `ip`, `device`, `page`) 
    VALUES (NOW(), '$ip', '$device', '$page')";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }


  function newMaterial($title, $img)
  {
    $sql = "INSERT INTO `materials` (`title`, `img`, `type`) 
    VALUES ('$title', '$img', '')";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function editMenuPosition($id, $title, $description, $price, $category, $pic)
  {
    $sql = "UPDATE `menu` SET `title`='$title', `description`='$description', `pic`='$pic', `price`=$price, `category`='$category'
    WHERE id = $id";
    if ($pic == "") {
      $sql = "UPDATE `menu` SET `title`='$title', `description`='$description', `price`=$price, `category`='$category'
      WHERE id = $id";
    }

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function removeMenuPosition($id)
  {

    $sql = "DELETE FROM menu WHERE id = $id";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function removeMaterial($id)
  {

    $sql = "DELETE FROM materials WHERE id = $id";

    if ($this->mysqli->query($sql) === TRUE) {
      return true;
    } else {
      return false;
    }
  }

  function getCategories()
  {
    $res = [];
    $sql = "SELECT * FROM categories";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getRegions()
  {
    $res = [];
    $sql = "SELECT * FROM delivery";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getOrders()
  {
    $res = [];
    $sql = "SELECT * FROM orders ORDER BY `date` DESC";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getNewOrders()
  {
    $res = [];
    $sql = "SELECT * FROM orders WHERE `state` = 'Новый' ORDER BY `date` DESC";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getPositions()
  {
    $res = [];
    $sql = "SELECT * FROM products";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getTopPositions()
  {
    $res = [];
    $sql = "SELECT * FROM products ORDER BY `views` DESC LIMIT 3";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getMaterials()
  {
    $res = [];
    $sql = "SELECT * FROM materials";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getAllMenu()
  {
    $res = [];
    $sql = "SELECT * FROM menu";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getAllOrders($page, $limit)
  {
    $res = [];
    $sql = "SELECT * FROM orders ORDER BY id DESC LIMIT $page, $limit";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $row["user"] = $this->getUserById($row["user_id"]);
        $row["destination"] = $this->getDestinationById($row["delivery"]);
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getOrdersCount()
  {
    $res = [];
    $sql = "SELECT COUNT(*) FROM orders";

    if ($result = $this->mysqli->query($sql)) {
      return $result->fetch_row();
    }

    return 0;
  }

  function getDelivery($id)
  {
    $sql = "SELECT * FROM destinations WHERE id=$id";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        return $row;
      }
      $result->free_result();
    }

    return ["id" => "-1", "destination" => "undefined", "price" => "0"];
  }

  function getMenuByCat($cat)
  {
    $res = [];
    $sql = "SELECT * FROM menu WHERE category='$cat'";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }
  function search($q)
  {
    $res = [];
    $sql = "SELECT * FROM menu WHERE title LIKE '%$q%'";

    if ($result = $this->mysqli->query($sql)) {
      while ($row = $result->fetch_assoc()) {
        $res[] = $row;
      }
      $result->free_result();
    }

    return $res;
  }

  function getPositionById($id)
  {
    $sql = "SELECT * FROM products WHERE id = $id";

    if ($result = $this->mysqli->query($sql)) {
      return $result->fetch_assoc();
    }

    return null;
  }

  function getMaterialById($id)
  {
    $sql = "SELECT * FROM materials WHERE id = $id";

    if ($result = $this->mysqli->query($sql)) {
      return $result->fetch_assoc();
    }

    return null;
  }

  function closeConnection()
  {
    $this->mysqli->close();
  }
}
