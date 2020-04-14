<?php
defined('BASEPATH') or exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class JwtEn extends CI_Controller
{
    public function index()
    {
        $privateKey = <<<EOD
-----BEGIN PRIVATE KEY-----
MIIEvAIBADANBgkqhkiG9w0BAQEFAASCBKYwggSiAgEAAoIBAQDJkXFclY/qu2vb
W1FYvj3iokRKg0p3dUQxeBb/EUS7+hHA0ijP18llJwr6PHz+gTsMKpy5Oko9KefW
lbaw+PKxJ/N7hZBhv9xk8PhQngQnwiUNrxqmdO4eYLtQAFuMTz62x9dcSh/27FzH
S4+2qNf4EffX/sUpPpFZy1enuY4HRC7s1QQRYoFSs8+5ZL1KahtSEz4Cg2dRf45n
HfDdWMLtUihglbsU4NXYbVBIGJKH7U/pr+GNbSoQbvJAcS4ZV5OcwAp3i/RiW0gM
fEYxRQRCicJUGC90v2yLSlUseQuwXGUrukDw+KExJgJjGI6upNJLyqOAOid7PA0v
/OebJMorAgMBAAECggEAQtu1SEprpCZqjiXqA4+Go2fDUxvdVWZWKjp1FkG6FMfL
n7OVyer/aEfdAkeSBjEDTvPLbD0DZupBdhHOuUC57z0bK/uPenzTM8Ah/UuMgUuK
UtGj+1aJrRXUy6Jyu0WFvcbnjjsgAx0/YPOVRbcXe7cqCED/UMDqIWirOHz5uTqy
9q4sY7qxE0toPYX09JxkQ1wAxXI9fDxJwW8tQpxeESJjMgXtDJrk/YsE8UtCjBPV
LYNDzyBJPtNL68lKb//5Y5PwzzLV9yxs0/ChAJs5nw2skmlV3mkssGxKmZMFRH8O
OLJu3RSiLZTANbCJf2Xm03kRlFgIuCHhaMumdSyPkQKBgQD8U6F7ZwWARp6dLvbr
Su4x/Zmcxn/c+VjgPW4Re4b613eZYCKF90xwGHo5af8MMaZuVRtfa1RChoxcmhdN
lmCSMOvaa91g7s/rLOsKy6hd7bcMJ3ltgZXYDlLG2MrzheFmPM7icq8pF2GlAOn7
r+uy6iXV/w7J5rNmQFvNuebRJwKBgQDMgKU8eNFxFw2MUI5vlf8v0+UaBZgOWsSm
416hHCE9/6lIB/NG/Hbp4NRq1MUuuhFCXkjjDNPdlgg8xU8uYwufL5x0yLlrmWPL
GR0+rgkQAunMVj1ioghndYlEiUSi/ozFIvbeRnjF0uJr0QO9jnO1ZjbeEcRm4bv0
15ewR/IZXQKBgHqZm/WcqeSY64qN/jV3E+NASDoPjKLumItj7a4a6gvJU3g3aK7U
6NPyYLiy0tS27xneyk0Dlk44l8yKplXxgfymPoLDNC5b+rRW/+Ef8S+qR+1k5LAb
bZYr53Zscbf/TfRiCVenx4ncrXoBxq6e3JPzBu1CX4okSPievrxn3kmzAoGAT57W
tpCjmtBK6hKDIlbYIBrz3AnJhe05G3Dy6u800hq0IeNWiJDLC4wJp/5nNyYiiiCD
aEMaSe+cDW0Uww60+6lh1OZBqu7xt6VziW/g/2bi+Derdrd3ZjCQ3SpEmuFYlXhj
fW8anorYtPmP50GLM1k0i4mHWjcRIua9nFimndECgYBEE7o93DYUo9IysDwhu7Yo
osCVEJ3E6C8cwXg30SHJMe6PvVwoB3suVlDpA6u7hU+ukf+p+d5H821a5+uWwAj3
BoqN6IY0Uaio9vjSr7PHIyD8ZYeBQjIlQvLaiXAzl+PU+xFpjPH91qefT9DmfxQ+
ScxuGelfuN1KpmIZoIEuGw==
-----END PRIVATE KEY-----
EOD;

        $payload = array(
            "sub" => "1228479",         // Unique user id string
            "name" => "Andreas Ardi",   // Full name of user
            "exp" => time() + 60 * 10   // 10 minutes expiration
        );

        // $jwt = JWT::encode($payload, $privateKey, 'RS256');
        // echo "Encoded : \n" . print_r($jwt, true);

        try {
            $token = JWT::encode($payload, $privateKey, 'RS256');
            http_response_code(200);
            header('Content-Type: application/json');
            echo json_encode(array("token" => $token));
        } catch (Exception $e) {
            http_response_code(500);
            header('Content-Type: application/json');
            echo $e->getMessage();
        }
    }
}
