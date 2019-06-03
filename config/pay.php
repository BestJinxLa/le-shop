<?php

return [
    'alipay' => [
        'app_id'         => '2016092400583112',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEArDgtp9NdB5pKiilKnxvqMpLxLG2T/JA9U5ZtVq69vnhl9lv0sxJ8brBE/O8cCwfX4a3jMYqWTUgzLt9MR9exw449qvNdGDDgg3Z+wuLupIMaOyb+9Xl1lWS5dJi4KdEI+M4nC5DW3FzaQaPuBI54gTecjSD85hZh9rzTPdVQ/OIKu3NuvngwnCObSLxCczPp/0QIx62kWU88VE9h5tFadACKa5PhbkYlPRAg/6hofpGNLTeuIVkuAnUdoReY0jlRjXcwOdFQlVlvIA/n12cBFJ6VGUaxs9yStl58P8Citf21Z7lXXRVeAHiFlVwIO2P+JuULzRDZ1QNJLtrArGTXFwIDAQAB',
        'private_key'    => 'MIIEpQIBAAKCAQEArsBJHxlT80iE1ZnEKjx5UAm2cgbh3bCm7gsVUMzIjuf34z/OTnL9JdwJ/pNkdoxWJc1XLC1YaZSHGaTUc4L2G8oK155ACr0ta3hbqiu68/QfCSv2HS9DsiRuYwGLEuBGWX7wyl3CVNZnvze8L3ThY59/8VoyWuEA78KW64Zc5IBQzGpTgpT+jB3R1XPB/Zg2VCAKBTmKPFBIFXN6r5/VeBPuWC4qtFACumJCgtRu3plsirK2T+74IffWmJcZ9fVDiEHaXv3VdeyfH2BxIFBpeoyEVXTLidbrkSXMzpi6gBsL/YUVyXrBGiHomuOOEvB8yhEcLruJWb5ixuQ/Cn5iqQIDAQABAoIBAQCXfS+mWwGQvEQTG2qXprcPsGvN67NvyEzdvRPsaKpQYD1fbhe9oCdd46NyYnnL3xprSNgR/vlPBagcjexyeow5SOwfQRuJc7flG4BzQ9ec1fr1q3t+j1OjIbvj7hmO8odp3AaHl8H4Y6mqdXmYtj0RbNqv8p4GdFmof0rvwBnVJwwzZ0tPHuCTdY43Rn9BTeeGkXYHW25isZAA/YaL58uB0DvjN+q2U1aoCLSZAijEn62vheSfpbpZOlHhD7LUAZINKr/yLrCqo6bCzWLkpD7Nhsq3skvqGe8qeLzBOTN571Ixd2B95pjpX3JhGwxO04af7zMhgsoWpmbx4S20S8KBAoGBAN6R6CQ8/U6efYwXY0LBnpTmRDOIWj7h5c9EcMb0hQO3X04TJNj+13dX4FHxSwYNoqpTVGHnjaTISZKubqFoI0sbPsVhMYya/UAp00OVGA0ncvm7aFXdyhZHiMuUJsKeJ6FlBpyIGGsAdcACspH9oBdmDiMHBcOHToQyfBioW4o5AoGBAMj/r1FytLPqHqrhcBuP7QctX48y8c5jLiozvCBjCtEPgyo4GuNvyil0OBVWvlDF7mFuRq+e175a0Vbv9ZAABfOVQrhKH1g10LpvBPQcLrKf8CcQ93xl0xr+Y/CNPktyK9AjvHjYF34JhXZKBg3Xji9ZFv9oAI5qBFlN3VuPp1vxAoGBAM3vlSsKn5qB/UqFTVu0SSYe1VYVQONUI04fVnZQQ08H+ZAFGKALVJRhY/aN28wTC8KrbbVVCfNBOwoUidqgv5876124K5+cvN0Eliy/JEzvhmvZ4pUorVbmA4XSY/bJXYPxNSfaqTVAbLMoC9AXK2zbChOQ6N1dMeIR0E8EYAbJAoGAMBb8m0AWe/VH4RqO+Ak3bMAuXNSThg20veQi3pzTubE8cJ170W6tr71erbxTTIAOyMDZqKsYczLHY0WGOy3GPsE3dWBGn5RAnFpzlPQpOBOMIcytadXy7EJxJtykSujGEsZ6EW+iL0WX6PVM/YLVQf7OwczgVTKIV9WJYJ6+LAECgYEApyFx+5gGg/hkSOt0YQN7YRZmIwDwhQdZox4lcoOhYM8lC3PdT1BIGXqAliA3YCQ1ToX7Hoa6dXMJGxGx6OPLwadkBymARQa0Qruqn4rtLZKnYVtf9yvwrxQidXGZZsLhEuafjThfOUUEX9xl1q6+FnOEx8cd3No8JjCEprDZw78=',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
