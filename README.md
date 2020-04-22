# Simple Laravel Blog

Main Part
* Post
* Comment
* Category
* Tag



## Database
- Post
    - id
    - prent_id ( nullable )
    - title
    - body ( nullable )

- Post-Meta
    - id
    - post_id
    - key
    - value

- Comment
    - id
    - user_id
    - post_id ( nullable )
    - body

- Category ( TODO! )
    - id
    - title
    - body ( nullable )

- Tag ( TODO! )
    - id
    - title
    - body ( nullable )
