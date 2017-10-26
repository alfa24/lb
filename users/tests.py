import unittest

from django.contrib.auth.models import User
from django.test import Client

from users.models import ProfileCompany, ProfileClient


class UsersTest(unittest.TestCase):
    def setUp(self):
        # Every test needs a client.
        self.client = Client(enforce_csrf_checks=False)

    def get_user(self, username):
        user = User.objects.get(username=username)
        return user

    # Post запрос на регистрацию пользователя
    def get_response(self, username, password, type):
        response = self.client.post('/accounts/signup/', {
            'username': username,
            'email': '',
            'first_name': 'Name',
            'last_name': 'qq',
            'phone': '5465',
            'type': type,
            'password1': password,
            'password2': password
        }, follow=True)
        return response

    # тест создания профиля компании
    def test_create_company(self):
        username = 'democompany'
        password = 'demo09876'
        type = 'company'

        response = self.get_response(username, password, type)

        self.assertEqual(response.status_code, 404)
        user = self.get_user(username)
        self.assertEqual(user.username, username)
        self.assertEqual(user.profile.type, type)
        profile = ProfileCompany(user_profile=user.profile)
        self.assertEqual(str(profile), username)
        # self.assertEqual(user.profile.feedback_nmb, 0)

    # тест создания профиля клиента
    def test_create_client(self):
        username = 'democlient'
        password = 'demo09876'
        type = 'client'

        response = self.get_response(username, password, type)

        self.assertEqual(response.status_code, 404)
        user = self.get_user(username)
        self.assertEqual(user.username, username)
        self.assertEqual(user.profile.type, type)
        profile = ProfileClient(user_profile=user.profile)
        self.assertEqual(str(profile), username)

