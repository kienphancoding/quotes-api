## Tính năng

- Thay vì thêm tất cả các câu vào database thì mình sẽ chọn lọc những cái hay nhất và thêm vào
- Hiển thị các tác giả và câu nói hay của họ - OK
- Hiển thị các chủ đề và câu nói theo chủ đề - OK
- Hiển thị người theo nghề nghiệp - OK
- Tìm kiếm - OK
- Random quotes - ok

## Cre : https://www.brainyquote.com/

## Thiết kế CSDL (use https://dbdiagram.io/d)

Table authors{
  id int [primary key]
  name varchar
  path varchar
  image_link varchar
  description varchar
  profession_id int
  updated_at timestamp
  created_at timestamp
}

Table topics{
  id int [primary key]
  name varchar
  path varchar
  updated_at timestamp
  created_at timestamp
}

Table quotes{
  id int [primary key]
  content text
  topic_id int
  author_id int
  updated_at timestamp
  created_at timestamp
}

Table professions{
  id int [primary key]
  name varchar
  path varchar
  updated_at timestamp
  created_at timestamp
}

Ref: "authors"."id" < "quotes"."author_id"

Ref: "topics"."id" < "quotes"."topic_id"

Ref: "professions"."id" < "authors"."profession_id"
