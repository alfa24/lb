# -*- coding: utf-8 -*-
# Generated by Django 1.11.6 on 2017-10-26 03:26
from __future__ import unicode_literals

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
        ('users', '0001_initial'),
    ]

    operations = [
        migrations.CreateModel(
            name='Service',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(blank=True, default=None, max_length=50, null=True, verbose_name='Название')),
                ('description', models.TextField(blank=True, default=None, null=True, verbose_name='Описание')),
                ('is_active', models.BooleanField(default=True, verbose_name='Активный')),
                ('created', models.DateTimeField(auto_now_add=True, verbose_name='Создан')),
                ('updated', models.DateTimeField(auto_now=True, verbose_name='Изменен')),
            ],
            options={
                'verbose_name': 'Услуга',
                'verbose_name_plural': 'Услуги',
            },
        ),
        migrations.CreateModel(
            name='ServiceCategory',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('name', models.CharField(blank=True, default=None, max_length=50, null=True, verbose_name='Название')),
                ('description', models.TextField(blank=True, default=None, null=True, verbose_name='Описание')),
                ('on_home_page', models.BooleanField(default=True, verbose_name='На главной')),
                ('is_active', models.BooleanField(default=True, verbose_name='Активный')),
                ('created', models.DateTimeField(auto_now_add=True, verbose_name='Создан')),
                ('updated', models.DateTimeField(auto_now=True, verbose_name='Изменен')),
            ],
            options={
                'verbose_name': 'Категория услуги',
                'verbose_name_plural': 'Категории услуг',
            },
        ),
        migrations.CreateModel(
            name='ServiceProfessional',
            fields=[
                ('id', models.AutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('duration_hours', models.DecimalField(blank=True, decimal_places=1, default=None, max_digits=3, null=True, verbose_name='Продолжительность (ч.)')),
                ('price', models.DecimalField(blank=True, decimal_places=2, default=None, max_digits=10, null=True, verbose_name='Стоимость (руб.)')),
                ('description', models.TextField(blank=True, default=None, null=True, verbose_name='Описание')),
                ('is_active', models.BooleanField(default=True, verbose_name='Активный')),
                ('created', models.DateTimeField(auto_now_add=True, verbose_name='Создан')),
                ('updated', models.DateTimeField(auto_now=True, verbose_name='Изменен')),
                ('professional', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='users.ProfileCompany')),
                ('service', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='services.Service')),
            ],
            options={
                'verbose_name': 'Услуга профессионала',
                'verbose_name_plural': 'Услуги профессионалов',
            },
        ),
        migrations.AddField(
            model_name='service',
            name='category',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='services.ServiceCategory'),
        ),
    ]